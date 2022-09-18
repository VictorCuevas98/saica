<div id="pdfView" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title">PDF</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <embed src="{{asset('storage/pdfs/' . $path)}}" frameborder="0" width="100%" height="600px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

