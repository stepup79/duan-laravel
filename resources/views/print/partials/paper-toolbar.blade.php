<section class="paper-toolbar paper-toolbar-top no-print">
    <form>
        <input type="button" value="In trang này" onClick="window.print()" />
    </form>

    <a class="btn btn-outline-warning" href="{{ route('admin.sanpham.index') }}">Về trang chủ</a>
    @yield('paper-toolbar-top')
</section>

<section class="paper-toolbar paper-toolbar-bottom no-print">
    <form>
        <input type="button" value="In trang này" onClick="window.print()" />
    </form>

    @yield('paper-toolbar-bottom')
</section>