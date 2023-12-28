

<div class="mb-3">
    <label for="Nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="Nombre" name="Nombre" value="{{ isset($empleado) ? $empleado->Nombre : '' }}">
</div>

<div class="mb-3">
    <label for="Apellido" class="form-label">Apellido</label>
    <input type="text" class="form-control" id="Apellido" name="Apellido" value="{{ isset($empleado) ? $empleado->Apellido : '' }}">
</div>

<div class="mb-3">
    <label for="Correo" class="form-label">Correo</label>
    <input type="email" class="form-control" id="Correo" name="Correo" aria-describedby="emailHelp" value="{{ isset($empleado) ? $empleado->Correo : '' }}">
</div>

<div class="mb-3">
    <label for="Dni" class="form-label">DNI</label>
    <input type="password" class="form-control" id="Dni" name="Dni" value="{{ isset($empleado) ? $empleado->Dni : '' }}">
</div>

<div class="mb-3">
    <label for="Foto">Foto</label>
    {{ isset($empleado) ? $empleado->Foto : '' }}
    <input type="file" name="Foto" id="Foto" class="form-control" value="">
</div>

<button type="submit" class="btn btn-primary" value="Enviar" id="Enviar">Enviar</button>
