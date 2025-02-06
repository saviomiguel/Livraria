<section class="container mt-4">
    <header>
        <h2 class="h4 text-dark">Atualizar Senha</h2>
        <p class="text-muted">Certifique-se de que sua conta está usando uma senha longa e aleatória para se manter segura.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Senha Atual</label>
            <input type="password" id="update_password_current_password" name="current_password" class="form-control" autocomplete="current-password">
            @if ($errors->updatePassword->get('current_password'))
                <div class="text-danger mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">Nova Senha</label>
            <input type="password" id="update_password_password" name="password" class="form-control" autocomplete="new-password">
            @if ($errors->updatePassword->get('password'))
                <div class="text-danger mt-1">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Confirmar Senha</label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
            @if ($errors->updatePassword->get('password_confirmation'))
                <div class="text-danger mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
            @if (session('status') === 'password-updated')
                <p class="text-success">Salvo.</p>
            @endif
        </div>
    </form>
</section>
