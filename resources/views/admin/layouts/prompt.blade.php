<div id="top-alert" class="alert alert-block alert-danger fade in" style="display:none;position: fixed;width:89.11%;z-index: 555">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="icon-remove"></i>
    </button>
    <strong class="msg" style="margin-right: 25px">Oh Warning !</strong><span class="message"></span>
</div>
@if(Session::has('success'))
    <div class="alert-msg alert alert-success fade in" style="position: fixed;width:89.11%;z-index: 555">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="icon-remove"></i>
        </button>
        <strong>Well Success!</strong> {{Session::get('success')}}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert-msg alert alert-block alert-danger fade in" style="position: fixed;width:89.11%;z-index: 555">
        <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="icon-remove"></i>
        </button>
        <strong>Oh Warning!</strong> {{Session::get('error')}}
    </div>
@endif