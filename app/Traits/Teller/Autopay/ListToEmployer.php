<?php

namespace App\Traits\Teller\Autopay;

trait ListToEmployer
{
    public function placeholder()
    {
        return <<<HTML
        <div>
            <div class="grid grid-cols-1 ">
                <div class="flex flex-col w-full bg-white rounded-lg shadow-md dark:bg-secondary-800">
                    <div class="px-4 py-2.5 flex justify-between items-center border-b dark:border-0 ">
                        <h3 class="font-medium whitespace-normal text-md text-secondary-700 dark:text-primary-500">
                            Autopay Listing To Employer
                        </h3>
                    </div>
                    <div class="px-2 py-5 md:px-4 animate-pulse">
                        <div class="flex flex-col mt-4 overflow-x-auto">
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <div>
                                    <div class="h-2 bg-gray-200 rounded-md dark:bg-gray-600 w-20 mb-2.5"></div>
                                    <div class="h-8 bg-gray-200 rounded-md dark:bg-gray-600 "></div>
                                </div>
                                <div>
                                    <div class="h-2 bg-gray-200 rounded-md dark:bg-gray-600 w-20 mb-2.5"></div>
                                    <div class="h-8 bg-gray-200 rounded-md dark:bg-gray-600 "></div>
                                </div>
                                <div class="h-8 bg-gray-200 rounded-md dark:bg-gray-600 w-20 mt-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    HTML;
    }
}