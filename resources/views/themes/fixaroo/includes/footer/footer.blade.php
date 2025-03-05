    </body>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/switchery/switchery.min.js') }}"></script>
    <!-- <script src="{{ asset('plugins/tag-it/tag-it.min.js') }}"></script> -->
    <!-- <script src="{{ asset('plugins/fast-click/fastclick.min.js') }}"></script> -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('plugins/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables/media/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- Logout link Request Scritp -->
    <script type="text/javascript">
        // $('.js-post-action-link').on('click', (event) => {
        //     event.preventDefault();
        //     const url = $(event.currentTarget).attr('href') + '?redirectTo=login';
        //     const redirectUrl = window.location.origin + '/login';
        //     const token = $('input[name="_token"]');

        //     const data = {
        //         "_token": token[0].value,
        //     };
        //     const spinner = document.getElementById("spinner");

        //     $.ajax({
        //       type: "POST",
        //       url: url,
        //       data: data,
        //       beforeSend: () => {
        //           spinner.removeAttribute('hidden');
        //       },
        //       success: (res) => {
        //         setTimeout(() => {
        //             // window.location.href = redirectUrl;
        //             console.log(res);
        //         }, 3000);
        //       },
        //       complete: () => {
        //         spinner.setAttribute('hidden', '');
        //       },
        //     });
        // });
    </script>

    <!-- Tinymce Editor -->
    <script>
        // // Form
        // tinymce.init({
        //     height: 250,
        //     max_height: 500,
        //     mode: "textarea",
        //     icons: 'material',
        //     selector:'textarea',
        //     plugins: 'link image table',
        //     contextmenu: 'link image table',
        //     elementpath: false,
        //     placeholder: 'Type here...',
        //     removed_menuitems: 'undo, redo',
        //     menu: {
        //         file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
        //         edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
        //         view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
        //         insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
        //         format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat' },
        //         tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
        //         table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
        //         help: { title: 'Help', items: 'help' }
        //     }
        // });
    </script>

    <!-- Paginaition -->
    <script>
        const pagination = document.querySelectorAll('pagination');
        pagination.forEach(page => page.classList.add('pagination-sm'));
    </script>
</html>