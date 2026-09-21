@extends('template')
@section('content')
<div class="container">
    <div class="row" style="margin: 30px 0">
        <div class="col-sm-10">
            <div id="loading-controls"><span>carregando player ...</span></div>
            <div id="waveform"></div>
            <div class="row text-center controls">
                <div class="col-sm"><i class="fa fa-step-backward" id="wv-skipBackward"></i></div>
                <div class="col-sm"><i class="fa fa-play" id="wv-playPause"></i></div>
                <div class="col-sm"><i class="fa fa-step-forward" id="wv-skipForward"></i></div>
                <div class="col-sm">
                    <!-- <i class="fa fa-volume-off" id="wv-toggleMute"></i> -->
                    <input type="range" class="range" min="0" max="5" step="0.1" id="volume">
                </div>
            </div>
            <hr />
        </div>
    </div>
    <div class="row list-group" id="playlist">
        <div id="loading-playlist" style="display: none;"><span>carregando playlist ...</span></div>
        @if(!empty($musics) > 0)
            @foreach ($musics as $m)
                <a href="musics/{{ $m }}" class="list-group-item">
                    <i class="glyphicon glyphicon-play"></i>
                    <i class="fa fa-music"></i> - {{ $m }}
                </a>
            @endforeach
        @endif
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-9">
            <a href="{{ route('random') }}" class="btn btn-outline-primary btn-add">
                <i class="fa fa-random"></i></small>
            </a>
            <a href="{{ route('order') }}" class="btn btn-outline-primary btn-add">
                <i class="fa fa-list-ol"></i>
            </a>
        </div>
        <div class="col-sm-3 float-right">
            <button type="button" class="btn btn-outline-primary btn-add"
            data-toggle="modal" data-target="#modal-music-add">Adicionar música</button>
        </div>
    </div>

    <div class="modal fade" id="modal-music-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="form-upload-music" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">

                        <div id="div-add-success" class="alert alert-success">Música adicionada!</div>
                        <div id="div-add-error" class="alert alert-danger">Ocorreu um erro ao adicionar a música. <br />
                            <small>Provavelmente, pelo tamanho do arquivo (post_max_size / upload_max_filesize, pela sua configuração no php.ini). Por favor, tente uma com o tamanho menor.</small></div>

                        <input id="uploadFile" class="f-input" />
                        <div class="fileUpload btn btn--browse">
                            <span>Procurar música</span>
                            <input id="uploadBtn" name="file-music" accept=".mp3, .wav" type="file" class="upload" />
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button id="btn-send-music" type="button" class="btn btn-success">Enviar música</button>
                  </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
