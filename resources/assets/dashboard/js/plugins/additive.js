const { template } = require("lodash");

(function($){
    $.fn.additive = function( options ){
        
        var templates  =  $.extend({
            selector : `
                <div class="__additive">
                    <div class="form">
                        <input type="text" class="filed" placeholder=":text1" />
                        <button type="button">&#x2b;</button>
                    </div>
                    <div class="content">
                        <ul>:text4</ul>
                    </div>
                </div>
            ` ,
            elementTemplate : `
                <li>
                    <span>:text2</span>
                    <input type="checkbox" checked name=":text3[]" value=":text2" onClick="return false;" />
                    <div class="delete">&#x2715;</div>
                </li>
            ` ,
            inputPlaceHolder : "افزودن مقدار جدید" ,
            element : null ,
            old : "data-old" , 
            emptyFiled : function(){
                
            }
        } , options ) ;

        return this.each(function() {

            var wrapper = $(this) ,
                dataItem = [] ; 
                
            function renderElementGhadimi(){
                var oldTemplate = wrapper.attr( templates.old ) ,
                    oldTemplateWrapper = `` ;
                if( oldTemplate != undefined ){
                    if( oldTemplate.length ){
                        list = oldTemplate.split(",") ;
                        if(list.length){
                            list.map(function(item){
                                dataItem.push(item) ;
                                oldTemplateWrapper += (templates.elementTemplate).replaceAll(":text2" , $.trim(item) ) ;
                            });
                        }
                    }
                }
                return oldTemplateWrapper ;
            }

            function renderTemplate(){
                var template = templates.selector ; 
                template = template.replaceAll(":text1" , templates.inputPlaceHolder ).replaceAll(":text4" , renderElementGhadimi ) ;
                return template ; 
            } 

            var getRenderElement = renderTemplate().replaceAll(":text3" , templates.element )
            
            wrapper.html( getRenderElement ) ; 
            // wrapper render files 
            
            wrapper.on("click" , ".delete" , function(){
                var li = $(this).closest("li") ,
                    valueText = $("input" , li ).val() ;
                    li.remove() ;
                    dataItem = dataItem.filter(function(elem){
                        return elem != valueText ; 
                    });
            });

            wrapper.on("click" , ".form button" , function(e){
                e.preventDefault() ; 
                var form  = $(this).closest(".form") ,
                    input = $("input[type=text]" , form ) ,
                    inputValue = $.trim(input.val()) ;

                if( inputValue.length && ($.inArray( inputValue , dataItem ) < 0) ){
                    input.val("") ;
                    dataItem.push( inputValue ) ;
                    var temp = templates.elementTemplate.replaceAll(":text2" , inputValue ).replaceAll(":text3" , templates.element ) ;
                    $(".content ul" , wrapper ).append( temp ) ; 
                }else{
                    return templates.emptyFiled() ;
                }
            })

        }) ;
    }
})(jQuery);