<x-layout>
    <x-parts.form
        sendText='Post veröffentlichen'
        :actionRoute="route('admin.post.creating')"
    >
        <x-slot name="header">
            <h1 class="text-3xl text-medium mb-4">Create Post</h1>
            {{--            <p class="text-xl mb-2">Nur zu, tob dich aus.</p>--}}
            {{--            <p>Call us at <a href="tel:+12314561231" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 transition-colors duration-300">+1 231 456 1231</a></p>--}}
        </x-slot>

        {{--        <x-slot name="note">--}}
        {{--            <h5 class="text-xl font-medium mb-3">Help</h5>--}}
        {{--            <p class="text-gray-700 mb-4">Need help or have any query? Don't hesitate, you can directly shoot us an <a href="mailto:" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">email</a> or call us at <a href="tel:" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">+1 231 456 1231</a></p>--}}
        {{--            <p class="text-gray-700">You can move to <a href="#" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">FAQs</a> or <a href="#" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">Support</a> page to get more information about our site.</p>--}}
        {{--        </x-slot>--}}

        <x-slot name="form">
            <input type="hidden" name="id" value="{{$post->id ?? null}}">

            <div class="sm:w-1/2 px-3 mb-6">
                <input type="text" name="title" placeholder="{{ __('title') }}"
                       class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input"
                       value="{{$post->title ?? ''}}">
            </div>
            <div class="sm:w-1/2 px-3 mb-6">
                <input type="text" name="slug" placeholder="{{ __('slug') }}"
                       class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input"
                       value="{{$post->slug ?? ''}}">
            </div>
            <div class="sm:w-1/2 px-3 mb-6">
                <x-parts.label
                    for="category_id" :value="__('Category')"
                />
            </div>
            <div class="sm:w-1/2 px-3 mb-6">
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if(isset($post) && $post->category_id == $category->id)
                                class="bg-blue-500"
                            @endif>
                            {{__(ucwords($category->name))}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="sm:w-1/2 px-3 mb-6">
                <x-parts.label
                    for="author_id" :value="__('Author')"
                />
            </div>
            <div class="sm:w-1/2 px-3 mb-6">
                <input type="text" name="author_id" placeholder="{{ __('author') }}"
                       class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input" value="">
            </div>

            <div class="sm:w-1/2 px-3 mb-6">
                <x-parts.label
                    for="image_id" :value="__('Image')"
                />
            </div>
            <div class="sm:w-1/2 px-3 mb-6">
                <input type="text" name="image_id" placeholder="{{ __('url') }}"
                       class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input" value="">
            </div>

            <div class="sm:w-full px-3">
                <label>
                    {{ __('excerpt') }}
                    <textarea name="excerpt" cols="30" rows="4" placeholder="{{ __('excerpt') }}"
                              class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input">{{$post->excerpt ?? ''}}</textarea>
                </label>
            </div>
            <div class="sm:w-full px-3">
                <label>
                    {{ __('body') }}
                    <textarea name="body" cols="30" rows="10" placeholder="{{ __('body') }}"
                              class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input">{{$post->body ?? ''}}</textarea>
                </label>
            </div>
        </x-slot>
    </x-parts.form>

</x-layout>
