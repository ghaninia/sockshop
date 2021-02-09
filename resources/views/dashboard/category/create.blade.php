<div class="modal fade" id="new-project">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>تعریف</h5>
                <button type="button" class="btn round" data-dismiss="modal">
                    <i class="feather-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="new">
                    <form class="needs-validation" novalidate="" id="form" action="{{ route("dashboard.categories.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="__galleries picture"></div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group has-top-label">
                                    <input required name="name" class="form-control" placeholder="نام">
                                </div>
                                <div class="form-group has-top-label">
                                    <input name="description" class="form-control" placeholder="توضیحات">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn primary">
                            درج
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
