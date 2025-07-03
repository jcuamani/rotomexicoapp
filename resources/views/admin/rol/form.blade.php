{{-- resources/views/roles/form.blade.php --}}
@csrf

<div class="mb-3">
    <label for="name" class="form-label">Nombre del rol</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $role->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Permisos</label>
    <div class="row">
        @foreach($permissions as $permission)
            <div class="col-md-4">
                <div class="form-check">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                           class="form-check-input"
                           {{ isset($role) && $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $permission->name }}</label>
                </div>
            </div>
        @endforeach
    </div>
</div>

<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
