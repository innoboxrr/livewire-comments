<div>
    @if($role != 'student')
        <div wire:ignore="" class="row">
            <div class="col-12">
                <a 
                    href="{{ route('forum.report', $blockId) }}" 
                    type="button" 
                    class="btn btn-light rounded-0 float-right"
                    target="_blanck">
                    Ver reporte de foro
                </a>
            </div>
        </div>
    @endif
    <div id="commentSystem_Content"></div>
    <script>
        var commentSystem_ContentID="{{ $blockId }}", commentSystem_Title="{{ $title }}",commentSystem_ContentURL="{{ url()->current() }}?role={{ $role }}&token=pa&callback={{ $callback }}",commentSystem_Language="es",commentSystem_FooterLinks="Off",commentSystem_userid="{{ auth()->id() }}",commentSystem_username="{{ auth()->user()->name }}",commentSystem_usericon="{{ route('lwc.comments.user.avatar', auth()->id()) }}",commentSystem_profillink="{{ url('user/' . auth()->id() . '/comments') }}",commentSystem_Domain="https://comment-system.innoboxrr.com";!function(){var e=document.createElement("script");e.type="text/javascript",e.async=!0,e.src=commentSystem_Domain+"/plugin/embed.js?ver={{ rand(1,100) }}",(document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]).appendChild(e)}();

        setTimeout(() => {
            document.querySelector('#commentSystem').setAttribute('scrolling','no');
        }, 1500);
    </script>
</div>
