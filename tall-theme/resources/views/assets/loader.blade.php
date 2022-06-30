 <!--Preloader starts-->
 <div x-data="_loader" x-show="open"
     class="flex  min-h-screen w-screen items-center justify-center z-50 fixed top-0 left-0 right-0 bottom-0 bg-white">
     <img src="{{ asset('img/preloader.gif') }}" alt="...">
 </div>
 <!--Preloader ends-->
 <script>
     document.addEventListener('alpine:init', () => {
         Alpine.data('_loader', () => ({
             open: true,
             init() {
                 this.open = false;
             }
         }))
     })
     document.addEventListener('load', () => {
        //  console.console.log("Carregou...");
     })
 </script>
