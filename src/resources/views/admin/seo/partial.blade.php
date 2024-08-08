
<div class="card">
    <div class="card-header">{{__('admin.seo.singular')}}</div>
    <div class="card-body">
        {!! $formSeo->renderFieldGroup('url') !!}
        {!! $formSeo->renderFieldGroup('title') !!}
        {!! $formSeo->renderFieldGroup('description') !!}
        {!! $formSeo->renderFieldGroup('tags') !!}
    </div>
</div>


@push('scripts.body.bottom')
    <script>
        document.querySelector('[seoTitle="seoTitle"]').addEventListener('change', changeTitle)
        document.querySelector('[seoTitle="seoTitle"]').addEventListener('blur', changeTitle)

        document.querySelector('[seoUrl="seoUrl"]').addEventListener('change', changeUrl)
        document.querySelector('[seoUrl="seoUrl"]').addEventListener('blur', changeUrl)


        function changeTitle(e) {
            const title = document.querySelector('[name="seo[title]"]');
            if(!title.value)
                title.value = e.target.value;
        }

        function changeUrl(e) {
            const url = document.querySelector('[name="seo[url]"]');
            if(!url.value)
                url.value = '/'+slugify(e.target.value);
        }
    </script>
@endpush
