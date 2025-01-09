<?php
$currentRoute = request()->route()->getName();
$isTransaksi = false;
$isDataMaster = false;

if (in_array($currentRoute, ['index.transaksi','index.riwayat_transaksi'])) {
  $isTransaksi = true;
}
if (in_array($currentRoute, ['index.paket','index.pelanggan','index.user'])) {
  $isDataMaster = true;
}
?>
<div class="app-brand demo">
  <a href="javascript:void(0)" class="app-brand-link text-center" style="margin: auto;">
    <span class="app-brand-logo demo">
    </span>
    <span class="app-brand-text demo menu-text fw-bold">{{implode(" ", array_slice(explode(" ",Auth::user()->name),0,2))}}</span>
  </a>

  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
    <i class="bx bx-chevron-left bx-sm align-middle"></i>
  </a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
  <li class="menu-header small text-uppercase">
    <span class="menu-header-text">Dashboard</span>
  </li>
  <li class="menu-item {{ (route('index.dashboard') == url()->current()) ? ' active' : '' }}">
    <a
    href=" {{ route('index.dashboard')}} "
    class="menu-link">
    <i class="menu-icon tf-icons bx bx-home"></i>
    <div data-i18n="">Dashboard</div>
  </a>
</li>
<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Data Master</span>
</li>
<li class="menu-item {{ $isDataMaster ? ' active open' : '' }}">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-brightness"></i>
    <div data-i18n="Dashboards">Data Master</div>
    <div class="badge bg-label-primary rounded-pill ms-auto">{{ Auth::check() && Auth::user()->level == 'Owner' ? '1' : '2' }}</div>
  </a>
  <ul class="menu-sub">
    @if(Auth::user()->level == 'Admin')
    <li class="menu-item {{ (route('index.paket') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('index.paket')}}" class="menu-link">
        <div data-i18n="">Paket</div>
      </a>
    </li>
    <li class="menu-item {{ (route('index.pelanggan') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('index.pelanggan')}}" class="menu-link">
        <div data-i18n="">Pelanggan</div>
      </a>
    </li>
    @else
    <li class="menu-item {{ (route('index.user') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('index.user')}}" class="menu-link">
        <div data-i18n="">Admin</div>
      </a>
    </li>
    @endif
  </ul>
</li>
<li class="menu-header small text-uppercase">
  <span class="menu-header-text"> {{ Auth::check() && Auth::user()->level == 'Owner' ? 'Transaksi & Riwayat Transaksi' : 'Transaksi' }}</span>
</li>
<li class="menu-item {{ $isTransaksi ? ' active open' : '' }}">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-analyse"></i>
    <div data-i18n="Dashboards">Data Transaksi</div>
    <div class="badge bg-label-primary rounded-pill ms-auto">{{ Auth::check() && Auth::user()->level == 'Owner' ? '2' : '1' }}</div>
  </a>
  <ul class="menu-sub">
    <li class="menu-item {{ (route('index.transaksi') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('index.transaksi')}}" class="menu-link">
        <div data-i18n="">Transaksi</div>
      </a>
    </li>
    @if(Auth::user()->level == 'Owner')
    <li class="menu-item {{ (route('index.riwayat_transaksi') == url()->current()) ? ' active' : '' }}">
      <a href="{{route('index.riwayat_transaksi')}}" class="menu-link">
        <div data-i18n="">Riwayat Transaksi</div>
      </a>
    </li>
    @endif
  </ul>
</li>
<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Rekap Laporan</span>
</li>
<li class="menu-item {{ (route('index.laporan') == url()->current()) ? ' active' : '' }}">
  <a
  href="{{ route('index.laporan') }}"
  class="menu-link">
  <i class="menu-icon tf-icons bx bx-book-content"></i>
  <div data-i18n="Email">Laporan Transaksi</div>
</a>
</li>
</ul>
