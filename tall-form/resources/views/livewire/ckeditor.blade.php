<div wire:ignore wire:key="{{ $name }}">
    <textarea id="{{ $name }}"> {{ $value }}</textarea>
</div>
<script src="{{ asset(config('tall-forms.ckeditor.editor-v2.js')) }}"></script>
@push('scripts')
    <script>
        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
                return {
                    upload() {
                        return loader.file.then(file => new Promise((resolve, reject) => {
                            @this.upload(
                                'photos',
                                file,
                                function(uploadedURL) {
                                    const trixUploadCompletedEvent =
                                        `editor-upload-completed:${btoa(uploadedURL)}`;
                                    const trixUploadCompletedListener = function(event) {
                                        window.removeEventListener(trixUploadCompletedEvent,
                                            trixUploadCompletedListener);
                                        resolve({
                                            default: event.detail.url
                                        })
                                    }
                                    window.addEventListener(trixUploadCompletedEvent,
                                        trixUploadCompletedListener);
                                    @this.call('completeUpload', uploadedURL, trixUploadCompletedEvent);
                                },
                                function() {},
                                function(event) {},
                            )
                        }))
                    },
                    abort() {}
                }
            }
        }
        ClassicEditor.create(document.getElementById('{{ $name }}'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('value', editor.getData())
                })
            })
            .catch(error => {
                // console.error('Oops, something went wrong!');
                // console.error(
                //     'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                // );
                // console.warn('Build id: g1spvgcch85q-nohdljl880ze');
                // console.error(error);
            });
    </script>
@endpush
