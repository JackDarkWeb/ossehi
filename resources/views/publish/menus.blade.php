


<!-- MENUS FORM Modal -->

<div class="modal fade" id="publishMenus" tabindex="-1" role="dialog" aria-labelledby="publishMenus" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" id="menus-form">
                <div class="modal-header">
                    <h3 class="modal-title" id="addressModalLabel">{{strtoupper(__('Create store / publish'))}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!-- End .modal-header -->

                <div class="modal-body">

                    <div class="form-group">

                        <div class="select-custom">
                            <select name="menus" id="menus" class="form-control form-control-sm">

                                <option >{{ __('Choose') }}</option>
                                <option value="store" >{{ strtoupper(__('Store')) }}</option>
                                <option value="announce" >{{ strtoupper(__('Announce or Publicity')) }}</option>
                                <option value="product" >{{ strtoupper(__('Product')) }}</option>

                            </select>
                        </div><!-- End .select-custom -->

                    </div><!-- End .form-group -->

                </div><!-- End .modal-body -->

                <a href="{{ route_name('create.store') }}" class="btn-quickview d-none" id="create-store" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                <a href="{{ route_name('create.various') }}" class="btn-quickview d-none" id="create-announce" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                <a href="{{ route_name('create.product') }}" class="btn-quickview d-none" id="create-product" title="Quick View"><i class="fas fa-external-link-alt"></i></a>

            </form>
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->




</div><!-- End .modal -->



