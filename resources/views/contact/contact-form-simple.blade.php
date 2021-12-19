<x-layout>
    <style>
        .input:focus {
            box-shadow: 0 0 0 0.2rem rgba(88, 99, 248, 0.15);
        }

    </style>

    <div class="contact-2 bg-gray-100 py-6 md:py-12">
        <div class="container px-4 mx-auto">

            <div class="text-center md:max-w-2xl md:mx-auto px-2 md:pb-4">
                <strong class="text-gray-500 uppercase">Get Started</strong>
                <h1 class="text-3xl md:text-4xl font-medium my-2">Get in Touch with Us</h1>
                <div class="contact-form mt-6 md:mt-12">

                    <div class="mb-4">
                        <textarea name="message" id="message" cols="30" rows="5" placeholder="Send us your queries or feedback" class="border-2 border-solid rounded py-2 px-3 placeholder-gray-500 placeholder-opacity-100 w-full focus:border-indigo-300 input transition-colors transtion-"></textarea>
                    </div>

                    <div class="mb-4 flex">
                        <div class="flex-grow">
                            <input type="text" placeholder="Your E-mail" class="border-2 border-solid rounded py-2 px-3 placeholder-gray-500 placeholder-opacity-100 w-full focus:border-indigo-300 input">
                        </div>
                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white border-2 border-solid border-indigo-600 rounded py-2 px-4 flex-shrink-0 ml-4 transition-colors duration-300">
                            <i class="fab fa-telegram-plane"></i>
                        </button>
                    </div>

                </div>
            </div>

            <div class="md:flex md:-mx-4 text-center mt-6 md:mt-12 pt-6 border-t-2 border-solid">
                <div class="md:px-4 md:w-1/3">
                    <address>
                        <div class="font-bold mb-2">West Chicago, IL</div>
                        <span>
            44 Shirley Ave.<br>
            West Chicago, IL 60185
          </span>
                    </address>
                </div>
                <div class="md:px-4 md:w-1/3 mt-8 md:mt-0">
                    <address>
                        <div class="font-bold mb-2">Orlando, FL</div>
                        <span>
            514 S. Magnolia St.<br>
            Orlando, FL 32806
          </span>
                    </address>
                </div>
                <div class="md:px-4 md:w-1/3 mt-8 md:mt-0">
                    <address>
                        <div class="font-bold mb-2">West Chicago, IL</div>
                        <span>
            4 Goldfield Rd.<br>
            Honolulu, HI 96815
          </span>
                    </address>
                </div>
            </div>

        </div>
    </div>
</x-layout>
