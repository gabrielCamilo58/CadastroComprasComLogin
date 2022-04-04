@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" id="name" name="name" class="form-control" value="{{$usuario->name ?? ''}}">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" class="form-control" value="{{$usuario->email ?? ''}}" >
</div>

<div class="form-group">
    <label for="cpf">CPF</label>
    <input type="number" name="cpf" id="cpf" class="form-control" value="{{$usuario->cpf ?? ''}}">
</div>

<button type="submit" class="btn btn-primary">Enviar</button>
