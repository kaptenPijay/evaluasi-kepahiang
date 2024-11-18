<header class="header w-100">
  <div class="top_header w-100">
    <button id="sidebarCollapse" class="btn border-0 btn-header"><i
        class="ri ri-menu-line btn-collapse-sidebar"></i></button>
    <div class="wrapper_user_data">
      {{-- <img src="{{asset('images/user-example-2.png')}}" alt="User Profile Image"> --}}
      <div class="username" name="fullname">
        {{ auth()->user()->name }}
      </div>
      <div class="role" name="role">
        {{ auth()->user()->role }}
      </div>
    </div>
  </div>
  <div class="bottom_header path_header" id="breadcrumb">
  </div>
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function () {
       $.ajax({
           url: "{{ route('dashboard.index') }}",
           success: (resp) => {
            const {fullname, role} = resp
            $("[name='fullname']").text(fullname)
            $("[name='role']").text(role)
           },
           error: (e) => {
            console.log('e', e);
           }
        })
      $('#sidebarCollapse').on('click', function () {
          $('#sidebar').toggleClass('d-none');
      });

      const appUrl = location.pathname
      const splittedUrl = appUrl.split('/').map((el) => el === 'back-office' ? 'home' : el).filter((e) => e)
      $('#breadcrumb').text(splittedUrl.join(' / '))
  });


</script>