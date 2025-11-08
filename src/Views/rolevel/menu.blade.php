<li>
  <a href="{{ $menu['url'] ? url($menu['url']) : 'javascript:void(0);' }}">{{ $menu['display'] }}</a>

  @if(isset($menu['childs']))
    <ul>
        {!! $view($menu['childs']) !!}
    </ul>
  @endif

</li>