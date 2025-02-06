<section class="card p-4 shadow-lg">
    <header>
        <h2 class="h4 text-dark fw-bold">Informações do Perfil</h2>
        <p class="text-muted">Atualize as informações do perfil da sua conta e o endereço de e-mail.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-warning">
                        Seu endereço de e-mail não foi verificado.
                        <button form="send-verification" class="btn btn-link p-0">Clique aqui para reenviar o e-mail de verificação.</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success">Um novo link de verificação foi enviado para o seu endereço de e-mail.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            @if (session('status') === 'profile-updated')
                <p class="text-success">Salvo.</p>
            @endif
        </div>
    </form>
</section>
