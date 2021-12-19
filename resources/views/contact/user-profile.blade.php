<x-layout>
    <style>
        .team-profile-wrap:first-child {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .team-profile-wrap:last-child {
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }
        .team-profile-wrap + .team-profile-wrap {
            border-top: 2px solid #dee2e6;
        }
        .team-profile-wrap:hover .team-profile-image img {
            transform: scale(1);
        }
        .team-profile-image img {
            transform: scale(1.2);
            transition: transform 0.3s;
        }
        @media (min-width: 768px) {
            .team-profile-wrap:first-child {
                border-top-right-radius: 0;
                border-bottom-left-radius: 1rem;
            }
            .team-profile-wrap:last-child {
                border-top-right-radius: 1rem;
                border-bottom-left-radius: 0;
            }
            .team-profile-wrap + .team-profile-wrap {
                border-top: none;
                border-left: 2px solid #dee2e6;
            }
        }

    </style>

    <div class="team-2 bg-gray-800 py-6 md:py-12 min-h-screen">

        <div class="container mx-auto px-4">

            <div class="md:w-10/12 xl:w-8/12 md:mx-auto">
                <h1 class="font-medium text-3xl md:text-4xl text-white text-center mb-4">Our Crew</h1>
                <p class="text-xl text-gray-400 text-center">We have the best of players in our team who created the <a href="//free-website-resources.com" class="inline-block font-semibold text-white">FWR Blocks</a>. You can learn more about our team and company culture by visiting each member's profile. If you are interested to join our company, you can shoot us an <a href="mailto:" class="inline-block font-semibold text-white">email</a></p>
            </div>

            <div class="md:flex md:-mx-4 mt-6 md:mt-12 xl:pt-12 px-6 md:px-0">

                <div class="team-profile-wrap bg-white mx-auto md:w-1/3 px-4 md:py-12">
                    <div class="team-profile text-center p-6">
                        <div class="team-profile-image w-32 h-32 mx-auto rounded-full overflow-hidden">
                            <img src="//via.placeholder.com/144x144/eee" alt="profile image" class="max-w-full h-auto">
                        </div>
                        <h5 class="text-gray-600 font-semibold uppercase mt-4 mb-2">John Doe</h5>
                        <p class="text-gray-600 text-sm">Lead Designer</p>
                        <div class="text-center mt-6">
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-linkedin-in"></span>
                            </a>
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-behance"></span>
                            </a>
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-dribbble"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="team-profile-wrap bg-white mx-auto md:w-1/3 px-4 md:py-12">
                    <div class="team-profile text-center p-6">
                        <div class="team-profile-image w-32 h-32 mx-auto rounded-full overflow-hidden">
                            <img src="//via.placeholder.com/144x144/eee" alt="profile image" class="max-w-full h-auto">
                        </div>
                        <h5 class="text-gray-600 font-semibold uppercase mt-4 mb-2">Mary Jane</h5>
                        <p class="text-gray-600 text-sm">Lead Developer</p>
                        <div class="text-center mt-6">
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-linkedin-in"></span>
                            </a>
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-behance"></span>
                            </a>
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-dribbble"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="team-profile-wrap bg-white mx-auto md:w-1/3 px-4 md:py-12">
                    <div class="team-profile text-center p-6">
                        <div class="team-profile-image w-32 h-32 mx-auto rounded-full overflow-hidden">
                            <img src="//via.placeholder.com/144x144/eee" alt="profile image" class="max-w-full h-auto">
                        </div>
                        <h5 class="text-gray-600 font-semibold uppercase mt-4 mb-2">Josh Thompson</h5>
                        <p class="text-gray-600 text-sm">Marketing Manager</p>
                        <div class="text-center mt-6">
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-linkedin-in"></span>
                            </a>
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-behance"></span>
                            </a>
                            <a href="#" class="w-10 h-10 inline-block overflow-hidden text-gray-500">
                                <span class="fab fa-dribbble"></span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-layout>
