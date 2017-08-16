@push('headers')
<link rel="stylesheet" type="text/css" href="/third_party/media_element/mediaelementplayer.min.css">
@endpush


@component("layouts.modal")
    @slot('id') player-modal @endslot
    @slot('title') Ouvir Gravação @endslot
    @slot('body')
        <div id="player-container">
            <center>
                <audio controls='controls'>
                    <source type='audio/wav'>
                </audio>
            </center>
        </div>
    @endslot
@endcomponent

@push('scripts')
<script type="text/javascript" src="/third_party/media_element/mediaelement-and-player.min.js"></script>
<script type="text/javascript">
	 $(function(){
        $('audio').mediaelementplayer({
            success: function(el){
                $(el).on('loadeddata', function(){
                    $('#player-container .loading').remove();
                    $('#player-container .mejs-container').show();
                    $('#player-modal').modal("show");
                });
            }
        });
        
        $("audio").on("error", function (e) {
           $.toaster({
             "title": "Atenção ",
             "message": "Um erro inesperado ocorreu. Tente novamente.",
             "priority": "danger"
           });
        });

        var playerId = $("#player-container audio").closest('.mejs-container').attr('id'),
            player = mejs.players[playerId];
        
        $("#player-modal").on('hidden.bs.modal', function(){
            player.pause();
        });
     });
</script>

@endpush