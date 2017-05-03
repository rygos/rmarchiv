<div class="row">
    <div class="col-md-12">
        <div class="list-group">
            <ul class='boxlist boxlisttable'>
                <li class="list-group-item active">{{ trans('index.randomgame.title') }}</li>
                <li class="list-group-item">
                <span class="rowprod">
                    <img width="100%" src="{{ route('screenshot.show', [$randomgame->id, 1]) }}"/>
                </span>
                </li>
                <li class="list-group-item">
            <span class='rowprod'>
                <span class='prodentry'>
                    @if($randomgame->gamefiles)
                        <span class='typeiconlist'>
                        <span class='typei type_{{ $randomgame->gamefiles[0]->gamefiletype->short  }}'
                              title='{{ $randomgame->gamefiles[0]->gamefiletype->title }}'>{{ $randomgame->gamefiles[0]->gamefiletype->title }}</span>
                    </span>
                    @endif
                    <span class="platformiconlist">
            <a href="{{ route('maker.show', $randomgame->maker->id) }}">
                <span class="typei type_{{ $randomgame->maker->short }}" title="{{ $randomgame->maker->title }}">
                    {{ $randomgame->maker->title }}
                </span>
            </a>
        </span>
                    <span class='prod'><a
                                href='{{ url('games', $randomgame->id) }}'>{{ $randomgame->title }}
                            @if($randomgame->subtitle)
                                <small> - {{ $randomgame->subtitle }}</small>
                            @endif
                        </a>
                        <span><img src="/assets/lng/16/{{ strtoupper($randomgame->language->short) }}.png"
                                   title="{{ $randomgame->language->name }}"></span>

                    </span>
                    <span class='group'>:: {!! \App\Helpers\DatabaseHelper::getDevelopersUrlList($randomgame->id) !!}
                    </span>
                </span>
            </span>
                </li>
            </ul>
        </div>
    </div>

</div>