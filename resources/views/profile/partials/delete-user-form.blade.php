<section class="container mt-4 p-4 border rounded bg-light">  
    <header>  
        <h2 class="text-danger">Excluir Conta</h2>  
        <p class="text-muted">  
            Uma vez que sua conta for excluída, todos os seus recursos e dados serão permanentemente apagados.  
        </p>  
    </header>  
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">  
        Excluir Conta  
    </button>  

    <!-- Modal de Confirmação -->  
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">  
        <div class="modal-dialog">  
            <div class="modal-content">  
                <div class="modal-header">  
                    <h5 class="modal-title text-danger" id="confirmDeleteModalLabel">Tem certeza de que deseja excluir sua conta?</h5>  
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>  
                </div>  
                <div class="modal-body">  
                    <form method="post" action="{{ route('profile.destroy') }}">  
                        @csrf  
                        @method('delete')  
                        <div class="mb-3">  
                            <label for="password" class="form-label">Senha</label>  
                            <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>  
                        </div>  
                        <div class="modal-footer">  
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>  
                            <button type="submit" class="btn btn-danger">Excluir Conta</button>  
                        </div>  
                    </form>  
                </div>  
            </div>  
        </div>  
    </div>  
</section>  