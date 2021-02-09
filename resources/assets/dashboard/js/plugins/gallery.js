const { size } = require("lodash");

(function($){
    $.fn.gallery = function(options){
        
        this.each(function(){

                function validate(file){
                    return (templates.accept).includes(file.type);
                }
        
                function fileSize(number) {
                    if(number < 1024) {
                    return number + templates.translate.byte ;
                    } else if(number >= 1024 && number < 1048576) {
                    return (number/1024).toFixed(1) + templates.translate.kb;
                    } else if(number >= 1048576) {
                    return (number/1048576).toFixed(1) + templates.translate.mb ;
                    }
                }

                function jsonFormat( text ){
                    return /^[\],:{}\s]*$/.test(text.replace(/\\["\\\/bfnrtu]/g, '@').
                    replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
                    replace(/(?:^|:|,)(?:\s*\[)+/g, '')) ;
                }


                var templates = $.extend({
                    el : null , 
                    filed : `
                        <label for="#:element">&#x2b;</label>
                        <input class="hidden" id="#:element" type="file" accept=":accept" />
                    ` ,
                    element : `
                        <li data-size=":size_raw" style="background-image:url(':src')">
                            <div class="information">
                                <span>:name</span>
                                <span>:size</span>
                            </div>
                            <div class="delete">&#x2715;</div>
                        </li>
                    ` ,
                    elementOldest : `
                        <li style="background-image:url(':src')">
                            <input type="hidden" value=":src"  name="previous_:element" />
                            <div class="delete">&#x2715;</div>
                        </li>
                    ` ,
                    wrap : `
                        <div class="filed">:filed</div>
                        <div class="label">:label</div>
                        <div class="info hidden">
                            <div class="sizer"></div>
                            <div class="counter"></div>
                        </div>
                        <ul class="import"></ul>
                    ` ,
                    accept : [
                        "image/jpeg",
                        "image/jpg",
                        "image/pjpeg",
                        "image/png",
                    ] ,
                    multiple : false ,
                    translate : {
                        mb : "مگابایت" ,
                        kb : "کیلوبایت" ,
                        byte : "بیت" ,
                        delete : "آیا میخواهید این آیتم را پاک نمایید ؟" ,
                    } ,
                    label : "گالری تصاویر" ,
                    duplicate : false , 
                    maxUnitSize : 0 ,
                    maxImagesSize : 1000000 ,
                    unit : 0 ,
                    oldestField : "data-oldest" ,
                    whenDeletedFile : function( object ){

                    } ,
                    maxUnitSizeCallback : function( size ){
                        alert(size) ;
                    },
                    maxImagesSizeCallback : function( size ) {
                        alert(size) ;
                    } ,
                    failedTypeCallback : function( type ) {
                        alert( type )
                    }
                } , options );
                
                var newVersionFiled = templates.filed ;
                    newVersionFiled = newVersionFiled.replaceAll(":element" , templates.el ) ,
                    newVersionFiled = newVersionFiled.replace(":accept" , templates.accept.join(",") ) ,
                    wraper = templates.wrap.replace( ":filed" , newVersionFiled ).replace(":label" , templates.label ) ;


                var w = $(this).html(wraper) ;
                let fullSize = 0 ,
                    counter = 0 ;

                var oldestWrapper = $(this).attr( templates.oldestField ) ;
                if( oldestWrapper ) {
                    var items = jsonFormat(oldestWrapper) ? JSON.parse( oldestWrapper ) : [ oldestWrapper ] ,
                        itemsWrapper = `` ;
                    items.map(function(item){
                        itemsWrapper += templates.elementOldest ;
                        itemsWrapper = itemsWrapper.replaceAll(":src" , item ) ;
                        itemsWrapper = itemsWrapper.replaceAll(":element" , templates.el + ( (templates.unit > 1 || templates.unit == 0)   ? '[]' : '') ) ;
                    });
                    $("ul.import" , w ).html( itemsWrapper ) ;
                    renderFeature() ;
                }

                function renderFile(file , clone , callback ){

                    read(file , function( image ){
                        var temp = templates.element ,
                        temp = temp.replaceAll(":name" , file.name ) ,
                        temp = temp.replace(":size_raw" , file.size ) ,
                        temp = temp.replace(":size" , fileSize( file.size ) ) ,
                        temp = temp.replaceAll(":src" , image  ) ;
                        clone.removeAttr("id") ;
                        clone.removeAttr("accept") ;
                        
                        if( templates.unit == 0 || templates.unit > 1){
                            clone.prop("multiple" , true ) ;
                            clone.attr("name" , templates.el + "[]" ) ;
                        }else{
                            clone.prop("multiple" , false ) ;
                            clone.attr("name" , templates.el ) ;
                        }
                     
                        temp = $(temp).append( clone )
                        $("ul.import" , w ).append( temp ) ;
                        callback() ;
                    });

                    function read(file , callback) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            callback(e.target.result)
                        } ;
                        reader.readAsDataURL(file);
                    }

                }

                $(this).on("click" , ".delete" , function(){
                    var accept = confirm( templates.translate.delete ) ;
                    if( accept ){
                        var wrapper = $(this).closest("li") ;
                        wrapper.remove() ;
                        renderFeature() ;
                        templates.whenDeletedFile(wrapper);
                    }
                });

                function renderFeature(){
                    var sizesNew = 0 ,
                        counterNew = 0 ;
                    
                    $("li" , w ).each(function(){
                        counterNew += 1 ; 
                        sizesNew += $(this).data("size") ;
                    }) ;

                    if( (counterNew >= templates.unit) && (templates.unit > 0) ){
                        $(".filed" , w).addClass("hidden") ;
                    }else{
                        $(".filed" , w).removeClass("hidden") ;
                    }

                    if( counterNew ){
                        $(".label" , w).addClass("hidden") ;
                        if( (templates.unit == 0 ) ){
                            $(".info" , w).removeClass("hidden") ;
                            $(".counter" , w).text(counterNew) ;
                            $(".sizer" , w).text( fileSize(sizesNew) ) ;
                        }
                    }else{
                        $(".label" , w).removeClass("hidden") ;
                        $(".info" , w).addClass("hidden") ;
                    }
                }

                $(this).on("change" , "input[type=file]" , function(){
                    var clone = $(this).clone() ;
                    $(this.files).each(function(){
                        const { size } = this ; 
                        if( (templates.maxUnitSize > size) || templates.maxUnitSize == 0 ){
                            if( validate( this ) ){
                                if( !((templates.maxImagesSize > fullSize + this.size ) || templates.maxImagesSize == 0) ){
                                    return templates.maxImagesSizeCallback( fullSize + this.size ) ;
                                }
                                renderFile( this , clone , function(){
                                    renderFeature() ;
                                }) ;
                            }else{
                                return templates.failedTypeCallback( this.type ) ;
                            }   
                        }else{
                            return templates.maxUnitSizeCallback( size ) ;
                        }
                    });
                }) ;

        })

    } ;
})(jQuery);