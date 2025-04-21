<div>
    <ul class=" list-group">
        @foreach($allRoles as $role)
            <li class="list-group-item">

                <label for="{{ $role->name }}" class="form-check-label">{{ $role->name }}</label>
            </li>
        @endforeach
    </ul>

</div>
