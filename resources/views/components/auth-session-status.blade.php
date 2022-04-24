@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success alert-dismissible']) }}>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Başarılı!</h5>

        {{ $status }}

    </div>
@endif
