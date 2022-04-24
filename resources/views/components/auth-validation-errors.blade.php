@props(['errors'])

@if ($errors->any())

    <div {{ $attributes->merge(['class' => 'alert alert-danger alert-dismissible']) }}>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-ban"></i> Hay Allah!</h5>{{ __('Yanlış birşeyler var.') }}



        <ul class="mt-3 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
