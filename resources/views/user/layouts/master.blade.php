<!DOCTYPE html>
<html lang="en">

@include('user.layouts.head')

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('user.layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('user.layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('main-content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      @include('user.layouts.footer')

      <script>
        (function () {
          function shouldReloadOnPageShow(event) {
            if (event && event.persisted) {
              return true;
            }

            try {
              if (window.performance && typeof window.performance.getEntriesByType === 'function') {
                var navEntries = window.performance.getEntriesByType('navigation');
                if (navEntries && navEntries[0] && navEntries[0].type === 'back_forward') {
                  return true;
                }
              }
            } catch (e) {
              // ignore
            }

            return false;
          }

          window.addEventListener('pageshow', function (event) {
            if (shouldReloadOnPageShow(event)) {
              window.location.reload();
            }
          });
        })();
      </script>

</body>

</html>
