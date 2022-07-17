<script type="text/javascript" src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
{{--<script type="text/javascript" src="{{asset('assets/js/tinymce/ar.js')}}"></script>--}}

<script>
    let numb = document.getElementById("accordionExample");
    let newQDI = 1;
    if (numb) {
        numb = numb.childElementCount;
        newQDI = numb + 1;
    }


    const checkbox = document.getElementById('typeId')

    if (checkbox) {
        checkbox.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                document.getElementById('letter').style.display = "none";
                document.getElementById('vid').style.display = "block";
            } else {
                document.getElementById('letter').style.display = "block";
                document.getElementById('vid').style.display = "none";
            }
        })
    }

    function qTypeChange(event) {

        let id = event.target.getAttribute("data-id");
        if (event.currentTarget.checked) {

            $('#multiple-choice_' + id).show();
            $('#multiple-choice_' + id + " :input").each(function () {
                $(this).attr('required', 'required');
            });


            $('#answer_' + id).hide();
            $('#answer_' + id + " textarea").each(function () {
                $(this).removeAttr('required');
            });
        } else {

            $('#answer_' + id).show();
            $('#answer_' + id + " textarea").each(function () {
                $(this).attr('required', 'required');
            });

            $('#multiple-choice_' + id).hide();
            $('#multiple-choice_' + id + " input").each(function () {
                $(this).removeAttr('required');
            });
        }

    }

    function delQ(el, event) {
        console.log(event);
        let id = event.target.getAttribute("data-id");
        console.log(id);
        $(el).parent().parent().remove();

    }

    // $('.qTypeChange').on('change',function (event){
    //     console.log('sdsd');
    //     let id = 1;
    //     if (event.currentTarget.checked) {
    //
    //                 $('#multiple-choice_'+id).show();
    //                 $('#answer_'+id).hide();
    //             } else {
    //                 $('#multiple-choice_'+id).hide();
    //                 $('#answer_'+id).show();
    //             }
    // })


    function x() {

        var template = document.getElementById("questions_template");
        // Get the contents of the template
        var templateHtml = template.innerHTML;
        // Final HTML variable as empty string

        templateHtml = templateHtml.replace(/<%= id %>/g, newQDI++);
        $("#accordionExample").append(templateHtml);
    }


    // var template = _.template( $( ".template-container" ).html() );
    // var markup = template({
    //     title: 'Title'
    // });
    @if(auth()->check())
    tinymce.init({
        selector: '.editor,#editor',
        plugins: ' advlist image video media autolink code codesample directionality table wordcount quickbars link lists numlist bullist',
        images_upload_url: "{{route('backend.upload.image',['_token' => csrf_token() ])}}",
        file_picker_types: 'file image media',
        image_caption: true,
        image_dimensions: true,
        //  directionality : 'rtl',
        //language:'en',
        quickbars_selection_toolbar: '  bold italic |h1 h2 h3 h4 h5 h6| formatselect | quicklink blockquote ',
        entity_encoding: "raw",
        verify_html: false,
        object_resizing: 'img',
    });

    function get_website_title() {
        return $('meta[name="title"]').attr('content');
    }

    function delete_submit(event) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.closest('form').submit();
            }
        })
    }
    var notificationDropdown = document.getElementById('notificationDropdown')
    notificationDropdown.addEventListener('show.bs.dropdown', function() {
        $.ajax({
            method: "POST",
            url: "{{route('notifications.see')}}",
            data: { _token: "{{csrf_token()}}" }
        }).done(function(res) {
            $('#dropdown-notifications-icon').fadeOut();
         //   favicon.badge(0);
        });
    });
    function append_notification_notifications(msg) {
        if (msg.count_unseen_notifications > 0) {
            $('#dropdown-notifications-icon').fadeIn(0);
            $('#dropdown-notifications-icon').text(msg.count_unseen_notifications);
        } else {
            $('#dropdown-notifications-icon').fadeOut(0);
        //    favicon.badge(0);
        }
        $('.notifications-container').empty();
        $('.notifications-container').append(msg.response);
        $('.notifications-container a').on('click', function() { window.location.href = $(this).attr('href'); });
    }
    function get_notifications() {
        $.ajax({
            method: "GET",
            url: "{{route('notifications.ajax')}}",
            success: function(data, textStatus, xhr) {

              //  favicon.badge(data.notifications.response.count_unseen_notifications);

                if (data.alert) {
                    var audio = new Audio('{{asset("/sounds/notification.wav")}}');
                    audio.play();
                }
                append_notification_notifications(data.notifications.response);
                if (data.notifications.response.count_unseen_notifications > 0) {
                    $('title').text('(' + parseInt(data.notifications.response.count_unseen_notifications) + ')' + " " +
                    get_website_title());

                } else {
                    $('title').text(get_website_title());
                }
            }
        });
    }
        window.focused = 25000;
    window.onfocus = function() {
        get_notifications();
        window.focused = 25000;
    };
    window.onblur = function() {
        window.focused = 60000;
    };
    function get_nots() {
        setTimeout(function() {
            get_notifications();
            get_nots();
        }, window.focused);
    }
    get_nots();
    @if($unreadNotifications!=session('seen_notifications') && $unreadNotifications!=0)
    @php
        session(['seen_notifications'=>$unreadNotifications]);
    @endphp
    var audio = new Audio('{{asset("/sounds/notification.wav")}}');
    audio.play();
    @endif
    @else
    /* Guest Js */


    @endif
    // let deleteFORM = document.getElementsByClassName('deleteFORM');
    // if(deleteFORM){
    //     deleteFORM.addEventListener('submit', function (e) {
    //         e.preventDefault();
    //         alert('sd');
    //     });
    // }


    Fancybox.bind("[data-fancybox]", {});
    Fancybox.bind("img.data-fancybox", {});
    Fancybox.bind(".data-fancybox img", {});
    // $('[data-fancybox]').fancybox({
    //     // Options will go here
    //     buttons: [
    //         'close'
    //     ],
    //     wheel: false,
    //     transitionEffect: "slide",
    //     // thumbs          : false,
    //     // hash            : false,
    //     loop: true,
    //     // keyboard        : true,
    //     toolbar: false,
    //     // animationEffect : false,
    //     // arrows          : true,
    //     clickContent: false
    // });
</script>
