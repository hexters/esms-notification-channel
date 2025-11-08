@extends(config('rolevel.template.extends'))

@section(config('rolevel.template.content'))
<script type="text/JavaScript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-lg-10">
      
      @php 
        $html = '';
        $permissions = $role->permissions;
        $htmlMenu = function ($menus, $isSub = false) use (&$htmlMenu, $permissions) {
          $html = '';
          foreach($menus as $menu) {
            $buttonAssign = view('rolevel::assign.partials.button', ['menu' => $menu, 'permissions' => $permissions]);
            $html .= '<li>';
            $checked = in_array($menu['uniqkey'], $permissions) ? 'checked' : '';
            $html .= '<input type="checkbox" name="uniqkeys[]" ' . $checked . ' value="' . $menu['uniqkey'] . '" /> ';
            $html .= $menu['display'] . $buttonAssign;
            if(config('rolevel.show_uniqkey')) {
              $html .= '<div class="bg-dark text-light p-2">
                        <small>' . $menu['uniqkey'] . '</small>
                    </div>';
            }

            if(isset($menu['childs'])) {
              $html .= '<ul>';
              $html .= $htmlMenu($menu['childs'], true);
              $html .= '</ul>';
            }

            $html .= '</li>';

          }
          return $html;
        }

      @endphp
        <div class="card">
          <form action="{{ url(config('rolevel.admin_prefix_link') . '/roles/' . $role->id) }}" method="post">
            @csrf
            <div class="card-body">
              <h4 class="card-body">Menus</h4>
              <ul>
                {!! $htmlMenu(rolevel()->menus()) !!}
              </ul>
            </div>
            <div class="card-footer text-right">
              <a href="{{ url(config('rolevel.admin_prefix_link') . '/roles') }}" class="btn btn-default">Back</a>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
    
    </div>
  </div>
</div>

<script type="text/JavaScript">
  $(document).ready(function() {
    $('input[type=checkbox]').click(function () {
        $(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
        var sibs = false;
        $(this).closest('ul').children('li').each(function () {
            if ($('input[type=checkbox]', this).is(':checked')) sibs = true;
        })
        $(this).parents('ul').prev().prop('checked', sibs);
    });
  });
</script>
@endsection