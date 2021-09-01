@foreach($sidebar as $key1=>$data)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordian"
                   href="#{{'category_' . $newKey = str_replace(" ", "", $key1)}}">
                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                    {{$key1}}
                </a>
            </h4>
        </div>
        <div id="{{ 'category_' . $newKey = str_replace(" ", "", $key1) }}"
             class="panel-collapse collapse">
            <div class="panel-body">
                @foreach($data as $value)
                    <div class="form-group full-width" data-category="{{$key1}}">
                        @foreach($jsons as $json)
                            @foreach($json as $key=>$item)
                                <input type="checkbox" name="filters" class="form-check-input"
                                       @if($item == $value and $key1 == $key)
                                       checked='checked'
                                       @endif
                                       data-value-id="{{ $value }}">
                                <label class="form-check-label"
                                       for="exampleCheck1">{{$value}}</label>
                            @endforeach
                        @endforeach
                    </div>
                @endforeach
                @if(count($data) > 8)
                    <a class="see-more"><span>See more</span></a>
                    <a class="see-less hide"><span>See Less</span></a>
                @endif
            </div>
        </div>
    </div>
@endforeach

<script>
    $(function () {
        $('.see-more').click(function () {
            $('.panel-body div:hidden').slice(0, 6).show();
            if ($('#category_Brands div').length - 1 == $('.panel-body div:visible').length) {
                $('.see-more').hide();
                $('.see-less').show();
            }
        });
    });
</script>

