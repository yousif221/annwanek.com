<header id="page-header">
    <div class="content-header">
        <div class="content-header-section">
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button>
        </div>
        <div class="content-header-section">
            
        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if(auth()->user()->hasRole('Administrator'))
        <i class="fa fa-bell" aria-hidden="true">
            @endif
            @if(auth()->user()->hasRole('Administrator'))
        @if (auth()->user()->unreadNotifications->count()>0)
        <span class="count animated text-light" id="notifications-count">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
        @endif  
        </i>
        @php 
        $notifications = auth()->user()->unreadNotifications;
     
        @endphp
      
    </button>
        @if(auth()->user()->hasRole('Administrator'))
                 
        <div class="dropdown-menu dropdown-menu-right min-width-200" style="text-align:center; font-size:smaller;overflow-y:scroll; max-height: 200px;" aria-labelledby="page-header-user-dropdown">
                
                    @forelse($notifications as $notification)

                        <div  class="dropdown-item">
                            
                            <a href="#" class="mark-as-read" data-id="{{ $notification->id }}" data-type="{{ $notification->data['type']}}">User Name: {{ $notification->data['name']??$notification->data['first_name'] }} filled {{ $notification->data['type'] }} Form  <br>     [{{ $notification->created_at }}]
                               
                           </a>
                        </div>
                    @empty
                        <p>There are no new notifications.</p>
                    @endforelse
                    <div class="dropdown-divider"></div>
                
                        @if(Count($notifications) !== 0)
                            <a href="#" onClick="window.location.reload()" id="mark-all">Mark all as read</a>
                        @endif
           



                </div>

                @endif


        
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user d-sm-none"></i>
                    <span class="d-none d-sm-inline-block">{{auth()->user()->name()}}</span>
                    <i class="fa fa-angle-down ml-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                    <a class="dropdown-item" href="{{route('admin.profile')}}">
                        <i class="si si-user mr-5"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item cursor" onclick="{document.getElementById('logout').submit();}">
                        <i class="si si-logout mr-5"></i> Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div>
</header>
