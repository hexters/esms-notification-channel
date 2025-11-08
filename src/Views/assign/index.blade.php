@extends(config('rolevel.template.extends'))

@section(config('rolevel.template.content'))

<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-lg-10">

      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Roles</h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Slug</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse($roles as $role)
                  <tr title="{{ $role->description }}">
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->slug }}</td>
                    <td class="text-right">
                      <a href="{{ url(config('rolevel.admin_prefix_link') . '/roles/' . $role->id) }}" class="btn btn-primary btn-sm">Assign Permission</a>
                    </td>
                  </tr>
                @empty 
                  <tr>
                    <td colspan="3">Role not found</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection