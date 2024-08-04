@foreach($comments as $comment)
<article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900  @if($comment->parent_id != null) ml-6 lg:ml-12 @endif">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"><img
                    class="mr-2 w-6 h-6 rounded-full"
                    src="{{ $comment->user->photo }}"
                    alt="{{ $comment->user->name }}">{{ $comment->user->name }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                    title="February 8th, 2022">{{  date('d M Y, h:i A', strtotime($comment->created_at)) }}</time></p>
        </div>
         
    </footer>
    <p class="text-gray-500 dark:text-gray-400">{{ $comment->body }}</p>
    <div class="flex items-center mt-4 space-x-4">
        <button type="button"
            class="reply-button flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            Reply
        </button>
        <form method="post" action="/comment/chapter" class="hidden reply-input w-full">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="p-2 w-full text-sm text-gray-900 border-0 rounded-lg h-10 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" />
                <input type="hidden" name="chapter_id" value="{{ $chapter_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <button type="submit"
                class="inline-flex items-center py-2 px-4 mt-4 text-sm font-medium text-center text-white bg-primary rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Reply
            </button>
        </form>
    </div>
</article>
@include('component.commentchapter', ['comments' => $comment->replies]) 
@endforeach