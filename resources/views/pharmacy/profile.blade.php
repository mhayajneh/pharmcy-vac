@extends('layouts.app')

@section('content')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <style>
        .animated {
            -webkit-transition: height 0.2s;
            -moz-transition: height 0.2s;
            transition: height 0.2s;
        }

        .stars
        {
            margin: 20px 0;
            font-size: 24px;
            color: #d17581;
        }
        .card-inner{
            margin-left: 4rem;
        }
    </style>
    <div class="row-cards row-deck">
        <div class="card">
            <div style="margin: 15px;">
               @if(isset(\Auth::user()->type) && \Auth::user()->type == '2')
                <a href="{{route('editPharmacyProfile', \Auth::user()->id)}}" class="btn btn-blue" style="float: right;">Edit</a>
                @endif

                <div class="row">
                <div class="col-sm-6 col-lg-5" >
                    <b> Name: </b> {{$pharmacyData->name}}
                </div>

                <div class="col-sm-6 col-lg-5" style="margin-left: 1.5rem;">
                    <b> Email: </b> {{$pharmacyData->email}}
                </div>
                <div class="col-sm-6 col-lg-5" >
                    <b> Manager: </b> {{$pharmacyData->manager}}
                </div>

                    <div class="col-sm-6 col-lg-5" >
                        <b> Number of students: </b> {{$pharmacyData->students}}
                    </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6 col-lg-5" style="margin-left: 10px;">
                    <b> Number: </b> {{$pharmacyData->number}}
                </div>

                <div class="col-sm-6 col-lg-5">
                    <b> Address: </b> {{$pharmacyData->location}}
                </div>


            </div>
            <br>

            <div class="row">
                <div class="col-sm-6 col-lg-5" style="margin-left: 10px;">
                    <b> Area: </b> {{$pharmacyData->area}}
                </div>

                <div class="col-sm-6 col-lg-5">
                    <b> City: </b> {{$pharmacyData->city}}
                </div>
            </div>
                   @for($i=1; $rating >= $i; $i++)
                       <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                   @endfor
            </div>
        </div>

    </div>

    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div>
                <h3 style="padding: 10px;display: inline-block;">Training Positions</h3>
                @if(isset(\Auth::user()->type) && \Auth::user()->type == '2')
                    <a href="{{ route('addPharmacyTraining', $pharmacyData->id) }}" class="btn btn-blue col-1" style="margin: 10px;display: inline-block;float: right;">Add New</a>
                @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Due Date</th>
                            <th>Created At</th>
                            <th class="w-1 text-center"><i class="fe fe-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $trainingPos as $pos )
                            <tr>
                                <td class="">
                                    <div>{{ $pos->title }}</div>
                                </td>
                                <td>
                                    <div>{{$pos->last_apply_date}}</div>
                                </td>
                                <td class="">
                                    <div>{{$pos->created_at}}</div>
                                </td>

                                <td>
                                    @if(isset(\Auth::user()->type) && \Auth::user()->type == '2')
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-primary">View</a>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('viewTrainees', $pos->id) }}" class="dropdown-item"><i class="dropdown-icon fe fe-delete"></i> View</a>
                                                <a href="{{ route('viewTrainees', $pos->id) }}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit</a>
                                                <a href="{{ route('states.show', $pos->id) }}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    @elseif(isset(\Auth::user()->type) && \Auth::user()->type == '3')
                                        <a href="{{route('applyTraining',[\Auth::user()->id, $pos->id])}}" class="btn btn-azure">Apply</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div>
                    <h3 style="padding: 10px;display: inline-block;"> Related Pharmacies</h3>


                </div>
                <div class="container">
                    <div class="row">
                        @foreach( $relatedPharmcies as $pos )
                            <div class="col-3">
                                <a href="{{route('pharmacy.view', $pos->id)}}">
                                    <div class="card" >
                                        <img class="card-img-top" src="{{storage_path('/app/image/' . $pos->image)}}" onerror="this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17323c1165d%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17323c1165d%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2299.4140625%22%20y%3D%2296.24375%22%3EImage%20cap%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E'" alt="Card image cap">
                                        <div class="card-body">
                                            <p class="card-title">{{ $pos->name }}</p>
                                            <p class="card-text">{{$pos->email}} <br> {{$pos->number}} <br> {{$pos->location}} <br>  {{$pos->city}} <br> {{$pos->manager}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div>
                    <h3 style="padding: 10px;display: inline-block;"> Leave a Review</h3>


                </div>
                <div class="row" id="post-review-box" >
                    <div class="col-md-12">
                        <form accept-charset="UTF-8" action="{{route('pharmc.review')}}" method="post">
                            @csrf
                            <input class="form-control" placeholder="Name" name="title">
                            <input type="hidden" name="pharm_id" value="{{$pharmacyData->id}}">
                            <input type="hidden" @if(\Illuminate\Support\Facades\Auth::id()) value="{{\Illuminate\Support\Facades\Auth::id()}}" @endif  name="user_id">
                            <input id="ratings-hidden" name="rating" type="hidden">
                            <textarea class="form-control animated" cols="50" id="new-review" name="body" placeholder="Enter your review here..." rows="5"></textarea>

                            <div class="text-right">
                                <div class="stars starrr" data-rating="0"></div>
                                <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                                    <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                                <button class="btn btn-success btn-lg" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div>
            <h3 style="padding: 10px;display: inline-block;"> Reviews</h3>


        </div>
        <div class="card-body">
            @foreach($reviews as $review)
            <div class="row">
                <div class="col-md-2">
                    <p class="text-secondary text-center">{{$review->created_at}}</p>
                </div>
                <div class="col-md-10">
                    <p>
                        @if($review->id)<h1><strong>{{\App\Models\User::find($review->id)->name}}</strong></h1>@endif
                    @for($i=1; $review->rating >= $i; $i++)
                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                    @endfor


                    </p>
                    <div class="clearfix"></div>
                    <h3>{{$review->title}}</h3>
                    <p>{{$review->body}}</p>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection

@section('scripts')
<script>
    (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

    var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

    $(function(){

        $('#new-review').autosize({append: "\n"});

        var reviewBox = $('#post-review-box');
        var newReview = $('#new-review');
        var openReviewBtn = $('#open-review-box');
        var closeReviewBtn = $('#close-review-box');
        var ratingsField = $('#ratings-hidden');

        openReviewBtn.click(function(e)
        {
            reviewBox.slideDown(400, function()
            {
                $('#new-review').trigger('autosize.resize');
                newReview.focus();
            });
            openReviewBtn.fadeOut(100);
            closeReviewBtn.show();
        });

        closeReviewBtn.click(function(e)
        {
            e.preventDefault();
            reviewBox.slideUp(300, function()
            {
                newReview.focus();
                openReviewBtn.fadeIn(200);
            });
            closeReviewBtn.hide();

        });

        $('.starrr').on('starrr:change', function(e, value){
            ratingsField.val(value);
        });
    });
</script>
@endsection