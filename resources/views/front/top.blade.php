<div class="top_section">
        <div class="search">
          <form>
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              <input type="search" placeholder="Search here" value="">
          </form>
        </div>

        <div class="col-about">
            <div class="col-notification">
                <ul>
                    <li><a href="#"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
                </ul>
            </div>

            <div class="col-profile-view">
                <span>{!! HTML::image('uploads/'.Auth::user()->image) !!}</span>
                <p><a href="#">{!! Auth::user()->first_name.' '.Auth::user()->last_name !!}</a></p>
            </div>
        </div>
</div>