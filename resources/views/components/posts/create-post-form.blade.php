<x-parts.form
{{--    class = "Send Post"--}}
{{--    :actionRoute = "route('admin.post.creating')"--}}
>
    <x-slot name="header">
            <h1 class="text-3xl text-medium mb-4">We would love to hear from you</h1>
            <p class="text-xl mb-2">Please submit your information and we will get back to you.</p>
            <p>Call us at <a href="tel:+12314561231" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 transition-colors duration-300">+1 231 456 1231</a></p>
    </x-slot>

    <x-slot name="note">
        <h5 class="text-xl font-medium mb-3">Help</h5>
        <p class="text-gray-700 mb-4">Need help or have any query? Don't hesitate, you can directly shoot us an <a href="mailto:" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">email</a> or call us at <a href="tel:" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">+1 231 456 1231</a></p>
        <p class="text-gray-700">You can move to <a href="#" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">FAQs</a> or <a href="#" class="text-indigo-600 border-b border-transparent hover:border-indigo-600 inline-block">Support</a> page to get more information about our site.</p>
    </x-slot>

    <x-slot name="form">
        <div class="sm:w-1/2 px-3 mb-6">
            <input type="text" placeholder="Full Name" class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input">
        </div>
        <div class="sm:w-1/2 px-3 mb-6">
            <input type="text" placeholder="Company Name" class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input">
        </div>
        <div class="sm:w-1/2 px-3 mb-6">
            <input type="text" placeholder="E-mail address" class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input">
        </div>
        <div class="sm:w-1/2 px-3 mb-6">
            <input type="text" placeholder="Phone Number" class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input">
        </div>
        <div class="sm:w-full px-3">
            <textarea name="message" id="message" cols="30" rows="4" placeholder="Your message here" class="border-2 rounded px-3 py-1 w-full focus:border-indigo-400 input"></textarea>
        </div>
    </x-slot>
</x-parts.form>
