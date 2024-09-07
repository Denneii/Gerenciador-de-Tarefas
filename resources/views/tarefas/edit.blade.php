<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Tarefa</h1>

        <!-- Formulário para editar tarefa -->
        <div class="card">
            <div class="card-header">Editar Tarefa</div>
            <div class="card-body">
                <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título da Tarefa</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $tarefa->titulo) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição da Tarefa</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao', $tarefa->descricao) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pendente" {{ old('status', $tarefa->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="concluída" {{ old('status', $tarefa->status) == 'concluída' ? 'selected' : '' }}>Concluída</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar Tarefa</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
