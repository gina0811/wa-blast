@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 text-primary"><span class="text-muted fw-light">Page/</span> WhatsApp Sender</h4>
    <div class="card">
        <div class="card-body">
            <!-- Form -->
            <form action="{{ route('wa.send.message') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tipe Pesan -->
                <div class="mb-3">
                    <label for="type-sender" class="form-label">Type</label>
                    <select class="form-select" name="type-sender" id="type-sender" aria-label="Default select example">
                        <option value="0" class="text-muted fw-light" selected>Type Sender</option>
                        <option value="text">Text</option>
                        <option value="image">Image</option>
                        <option value="audio">Audio</option>
                        <option value="document">Document</option>
                        <option value="video">Video</option>
                    </select>
                </div>

                <!-- Nomor Tujuan -->
                <div class="mb-3">
                    <label class="form-label" for="data_number">Number</label>
                    <select class="form-control" id="data_number" name="number_sender[]" multiple="multiple"></select>

                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="all_phone" />
                        <label class="form-check-label" for="all_phone"> All Phone </label>
                    </div>
                </div>

                <!-- Input File (Dinamis) -->
                <div class="mb-3" id="file_upload_section" style="display: none;">
                    <label class="form-label" for="file_upload">Upload File</label>
                    <input type="file" class="form-control" id="file_upload" name="file_upload" accept="">
                </div>

                <!-- Input Caption -->
                <div class="mb-3" id="caption_section" style="display: none;">
                    <label class="form-label" for="caption">Caption</label>
                    <textarea 
                        id="caption"
                        class="form-control"
                        placeholder="Write a caption here..."
                        name="caption_sender"></textarea>
                </div>

                <!-- Pesan (Untuk Teks) -->
                <div class="mb-3" id="input_message">
                    <label class="form-label" for="data_message">Message</label>
                    <textarea 
                        id="data_message"
                        class="form-control"
                        placeholder="Hi, Do you have a moment to talk Gina?"
                        name="message_sender"></textarea>
                </div>

                <!-- Tombol Kirim -->
                <button type="submit" class="btn btn-primary" id="btn_send">Send</button>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan Select2 dan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('#data_number').select2({
            placeholder: "Select or input numbers",
            tags: true,
            tokenSeparators: [',', ' ']
        });

        // Checkbox All Phone
        $('#all_phone').on('change', function() {
            if ($(this).is(':checked')) {
                $('#data_number').prop('disabled', true).val(null).trigger('change');
            } else {
                $('#data_number').prop('disabled', false);
            }
        });

        // Tampilkan Input File dan Caption Berdasarkan Tipe Pesan
        $('#type-sender').on('change', function() {
            var type = $(this).val();
            var fileInput = $('#file_upload');
            var fileSection = $('#file_upload_section');
            var captionSection = $('#caption_section');
            var messageInput = $('#input_message');

            // Reset semua bagian
            fileSection.hide();
            captionSection.hide();
            messageInput.hide();
            fileInput.val('');

            if (type === 'text') {
                messageInput.show();
            } else if (type === 'image' || type === 'video' || type === 'document' || type === 'gif' || type === 'audio') {
                fileSection.show();
                captionSection.show();

                if (type === 'image') {
                    fileInput.attr('accept', 'image/*');
                } else if (type === 'audio') {
                    fileInput.attr('accept', 'audio/*');
                } else if (type === 'document') {
                    fileInput.attr('accept', '.pdf,.doc,.docx,.xls,.xlsx');
                } else if (type === 'video') {
                    fileInput.attr('accept', 'video/*');
                } else if (type === 'gif') {
                    fileInput.attr('accept', 'image/gif');
                }
            }
        });

        // Default: Tampilkan pesan
        $('#input_message').show();
    });
</script>
@endsection
