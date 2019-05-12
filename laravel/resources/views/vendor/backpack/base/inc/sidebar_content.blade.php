<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Manage Shop</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href='{{ backpack_url('produks') }}'><i class='fa fa-tag'></i> <span>Insert Product</span></a></li>
    </ul>
  </li>

<li><a href='{{ backpack_url('produks') }}'><i class='fa fa-tag'></i> <span>Insert Product</span></a></li>