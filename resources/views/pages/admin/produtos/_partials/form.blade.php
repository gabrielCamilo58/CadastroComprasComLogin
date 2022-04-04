@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" id="name" name="name" class="form-control" value="{{$produto->name ?? ''}}">
</div>
<div class="form-group">
    <label for="price">Preço</label>
    <input type="float" id="price" name="price" class="form-control" value="{{$produto->price ?? ''}}" >
</div>

<div class="form-group">
    <label for="codBarras">Codigo de Barras</label>
    <input type="number" id="codBarras" name="codBarras" class="form-control" value="{{$produto->codBarras ?? ''}}" >
</div>

<div class="form-group">
    <label for="description">Descrição</label>
    <input type="text" name="description" id="description" class="form-control" value="{{$produto->description ?? ''}}">
</div>

<div class="form-group">
    <label for="img">Imagem</label>
    <input type="file" name="img" id="img" class="form-control">
</div>

<button type="submit" class="btn btn-primary">Enviar</button>
