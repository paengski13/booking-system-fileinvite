<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="app"></div>
            <script>
              window.auth_user = {{ Auth::user() ? Auth::user()->id : null }};
            </script>
        </div>
    </div>
</x-app-layout>
