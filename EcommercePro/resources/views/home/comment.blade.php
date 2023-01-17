<div style="text-align: center; padding-bottom: 30px;">
    <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px;">Comments</h1>
    <form action="{{ url('add_comment') }}" method="post">
        @csrf
        <textarea style="height: 150px; width: 600px;" placeholder="Comment something here..." name="comment"></textarea>
        <br />
        <input type="submit" class="btn btn-primary" value="Comment" />
    </form>
</div>
<div style="padding-left: 20%;">
    <h1 style="font-size: 20px; padding-bottom: 20px;">All Comments</h1>
    @foreach ($comment as $item)
        <div>
            <b>{{ $item->name }}</b>
            <p>{{ $item->comment }}</p>
            <a style="color: blue;" href="javascript::void(0);" onclick="reply(this)"
                data-Commentid="{{ $item->id }}">Reply</a>
            @foreach ($reply as $item_reply)
                {{-- hiển thị reply theo id comment --}}
                @if ($item_reply->comment_id == $item->id)
                    <div style="padding-left: 3%; padding-bottom: 10px;">
                        <b>{{ $item_reply->name }}</b>
                        <p>{{ $item_reply->reply }}</p>
                        <a style="color: blue;" href="javascript::void(0);" onclick="reply(this)"
                            data-Commentid="{{ $item->id }}">Reply</a>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
    <!-- Reply Textbox -->
    <div style="display: none;" class="replyDiv">
        <form action="{{ url('add_reply') }}" method="post">
            @csrf
            <input type="text" id="commentId" name="commentId" hidden /> <!-- hidden ẩn id-->
            <textarea style="height: 100px; width: 500px;" name="reply" placeholder="Write something here"></textarea>
            <br />
            <!-- javascript::void(0); // không reload lại trang -->
            <button type="submit"class="btn btn-primary">Reply</button>
            <a href="javascript::void(0);" class="btn btn-danger" onclick="reply_close(this)">Close</a>
        </form>
    </div>
</div>
