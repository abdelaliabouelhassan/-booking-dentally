<template>
  <div class="my-component-scoped">
    <div class="w-full space-y-14" :class="{ dark: dark }">
      <div class="w-full flex flex-col items-start space-y-5">
        <span class="font-medium text-2xl text-gray-900 dark:text-gray-300"
          >Report Generator</span
        >
        <div class="w-full flex md:flex-row flex-col items-start space-y-4 md:space-y-0 md:justify-between md:items-center">
          <div class="flex md:flex-row flex-col items-start space-y-4 md:space-y-0 md:items-center md:space-x-14">
            <span class="text-xl font-normal">Filter By </span>
            <div class="flex items-center space-x-4 relative">
              <div
                @click="showReason = !showReason"
                class="
                  p-2
                  bg-gray-500
                  rounded-2xl
                  cursor-pointer
                  hover:bg-gray-600
                "
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-4 h-4 text-white"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"
                  />
                </svg>
              </div>
              <span
                @click="showReason = !showReason"
                class="
                  text-xl
                  font-semibold
                  cursor-pointer
                  hover:text-opacity-80
                "
                >Reason</span
              >
              <div
                v-if="showReason"
                class="
                  p-5
                  rounded-2xl
                  absolute
                  shadow-md
                  bg-white
                  dark:bg-gray-800
                  w-[400px]
                  space-y-8
                  z-50
                  top-10
                "
              >
                <div class="w-full flex items-center justify-between">
                  <span
                    class="
                      font-medium
                      text-2xl text-gray-900
                      dark:text-gray-100
                    "
                    >Reasons</span
                  >
                  <div class="flex items-center space-x-4">
                    <span
                      @click="SelectAllResons"
                      class="
                        text-blue-500
                        font-medium
                        text-base
                        cursor-pointer
                        hover:text-opacity-70
                      "
                      >All</span
                    >
                    <span
                      @click="SelectedResons = []"
                      class="
                        text-blue-500
                        font-medium
                        text-base
                        cursor-pointer
                        hover:text-opacity-70
                      "
                      >Clear</span
                    >
                  </div>
                </div>

                <div
                  class="
                    flex flex-col
                    items-start
                    space-y-4
                    max-h-96
                    overflow-y-auto
                  "
                >
                  <div
                    class="flex items-center space-x-4"
                    v-for="(item, index, key) in Resons"
                    :key="key"
                  >
                    <input
                      :id="index"
                      type="checkbox"
                      :value="item.value"
                      v-model="SelectedResons"
                      class="
                        w-5
                        h-5
                        text-blue-600
                        bg-gray-100
                        rounded
                        border-gray-300
                        focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-800
                        focus:ring-2
                        dark:bg-gray-700 dark:border-gray-600
                      "
                    />
                    <label
                      :for="index"
                      class="text-xl font-semibold max-w-[19rem]"
                      >{{ item.name }}</label
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="flex items-center space-x-4 relative">
              <div
                @click="showPractitioner = !showPractitioner"
                class="
                  p-2
                  bg-gray-500
                  rounded-2xl
                  cursor-pointer
                  hover:bg-gray-600
                "
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-4 h-4 text-white"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"
                  />
                </svg>
              </div>
              <span
                @click="showPractitioner = !showPractitioner"
                class="
                  text-xl
                  font-semibold
                  cursor-pointer
                  hover:text-opacity-80
                "
                >Practitioner</span
              >

              <div
                v-if="showPractitioner"
                class="
                  p-5
                  rounded-2xl
                  absolute
                  shadow-md
                  bg-white
                  dark:bg-gray-800
                  w-[400px]
                  space-y-8
                  z-50
                  top-10
                "
              >
                <div class="w-full flex items-center justify-between">
                  <span
                    class="
                      font-medium
                      text-2xl text-gray-900
                      dark:text-gray-100
                    "
                    >Practitioner Member</span
                  >
                  <div class="flex items-center space-x-4">
                    <!-- <span
                     @click="SelectAllPractitioner"
                      class="
                        text-blue-500
                        font-medium
                        text-base
                        cursor-pointer
                        hover:text-opacity-70
                      "
                      >All</span
                    > -->
                    <span
                      @click="SelectedPractitioners = null"
                      class="
                        text-blue-500
                        font-medium
                        text-base
                        cursor-pointer
                        hover:text-opacity-70
                      "
                      >Clear</span
                    >
                  </div>
                </div>

                <div
                  class="
                    flex flex-col
                    items-start
                    space-y-4
                    max-h-96
                    overflow-y-auto
                  "
                >
                  <div
                    class="flex items-center space-x-4"
                    v-for="(item, index, key) in Practitioners"
                    :key="key"
                  >
                    <input
                      :id="index"
                      type="radio"
                      v-model="SelectedPractitioners"
                      :value="item.id"
                      name="SelectedPractitioners"
                      class="
                        w-5
                        h-5
                        text-blue-600
                        bg-gray-100
                        rounded
                        border-gray-300
                        focus:ring-blue-500
                        dark:focus:ring-blue-600 dark:ring-offset-gray-800
                        focus:ring-2
                        dark:bg-gray-700 dark:border-gray-600
                      "
                    />
                    <label :for="index" class="text-xl font-semibold"
                      >{{ item.user.title == "Dr" ? "Dr" : "" }}
                      {{ item.user.first_name }} {{ item.user.middle_name }}
                      {{ item.user.last_name }}</label
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="flex items-center relative">
            <button
              @click="SelectNextPeriode"
              class="h-10 px-2 bg-gray-500 rounded-l-2xl hover:bg-opacity-60"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 text-white"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15.75 19.5L8.25 12l7.5-7.5"
                />
              </svg>
            </button>
            <button
              @click="showDate = !showDate"
              class="
                h-10
                px-8
                bg-gray-600
                text-white text-xl
                font-medium
                hover:bg-opacity-60
              "
            >
              {{ FilterPeriode[PeriodeIndex].name }}
            </button>
            <button
              @click="SelectPrevPeriode"
              class="h-10 px-2 bg-gray-500 rounded-r-2xl hover:bg-opacity-60"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 text-white"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M8.25 4.5l7.5 7.5-7.5 7.5"
                />
              </svg>
            </button>
            <div
              v-if="showDate"
              class="
                p-5
                rounded-2xl
                absolute
                shadow-md
                bg-white
                dark:bg-gray-800
                w-[200px]
                space-y-8
                z-50
                top-12
                right-10
              "
            >
              <div class="flex flex-col items-start space-y-4 w-full">
                <div
                  class="flex items-center space-x-4 w-full"
                  v-for="(item, index) in FilterPeriode"
                  :key="index"
                >
                  <div
                    @click="SelectPeriode(item)"
                    :class="{ 'dark:bg-gray-600 bg-gray-800': item.active }"
                    class="
                      w-full
                      py-2
                      text-center
                      flex
                      dark:hover:bg-gray-600
                      hover:bg-gray-800
                      group
                      rounded-xl
                      cursor-pointer
                    "
                  >
                    <span
                      class="
                        text-xl
                        dark:text-white
                        text-center
                        font-semibold
                        m-auto
                        group-hover:text-white
                      "
                      >{{ item.name }}</span
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-full">
        <apexchart
          v-if="show"
          class="w-full"
          height="600"
          type="bar"
          :options="options"
          :series="series"
          ref="chartRef"
        ></apexchart>

        <div
          v-else
          class="w-full h-[600px] bg-gray-400 dark:bg-gray-800 flex rounded-2xl"
        >
          <div class="m-auto flex flex-col items-center space-y-4">
            <img src="/assets/loading.gif" alt="" />
            <div class="flex flex-col items-center space-y-2">
              <span class="font-medium text-4xl text-primary-600"
                >Processing ({{ currentPage }}/ {{ totalPage }})...</span
              >
              <span class="font-medium text-xl text-gray-900 dark:text-gray-300"
                >We are processing the data, it may take some time.</span
              >
            </div>
          </div>
        </div>
      </div>
      <div class="w-full flex flex-col items-start space-y-8">
      <div class="flex items-start space-x-10">
          <div class="flex flex-col items-start space-y-2">
            <span
              class="
                text-xl
                font-normal
                capitalize
                text-gray-900
                dark:text-gray-300
              "
              >Total Appointments</span
            >
            <span class="text-2xl font-semibold"
              >{{ totalResultTable }} Appointments
            </span>
          </div>
          <div class="flex flex-col items-start space-y-2">
            <span
              class="
                text-xl
                font-normal
                capitalize
                text-gray-900
                dark:text-gray-300
              "
              >Total Hours</span
            >
            <span class="text-2xl font-semibold">{{ totalTime }}</span>
          </div>
        </div>

        <div class="w-full">
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div
              class="
                flex flex-col
                md:flex-row md:items-center
                py-3
                border-b border-gray-200
                dark:border-gray-700
              "
            >
              <!---->
            </div>
            <div class="relative">
              <!---->
              <div class="overflow-hidden overflow-x-auto relative">
                <table class="w-full" data-testid="resource-table">
                  <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                      <th
                        class="
                          text-left
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <span class="hidden">Resource</span>
                      </th>
                      <th
                        class="
                          text-left
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <button
                          type="button"
                          class="
                            cursor-pointer
                            inline-flex
                            items-center
                            focus:outline-none focus:ring
                            ring-primary-200
                            dark:ring-gray-600
                            rounded
                          "
                          dusk="sort-id"
                          aria-sort="none"
                        >
                          <span
                            class="
                              inline-flex
                              font-sans font-bold
                              uppercase
                              text-xxs
                              tracking-wide
                              text-gray-500
                            "
                            >ID</span
                          >
                        </button>
                      </th>
                      <th
                        class="
                          text-center
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <span></span>
                      </th>
                       <th
                        class="
                          text-left
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <button
                          type="button"
                          class="
                            cursor-pointer
                            inline-flex
                            items-center
                            focus:outline-none focus:ring
                            ring-primary-200
                            dark:ring-gray-600
                            rounded
                          "
                          dusk="sort-name"
                          aria-sort="none"
                        >
                          <span
                            class="
                              inline-flex
                              font-sans font-bold
                              uppercase
                              text-xxs
                              tracking-wide
                              text-gray-500
                            "
                            >practitioner</span
                          >
                        </button>
                      </th>
                      <th
                        class="
                          text-center
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <span></span>
                      </th>
                      
                      <th
                        class="
                          text-left
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <button
                          type="button"
                          class="
                            cursor-pointer
                            inline-flex
                            items-center
                            focus:outline-none focus:ring
                            ring-primary-200
                            dark:ring-gray-600
                            rounded
                          "
                          dusk="sort-name"
                          aria-sort="none"
                        >
                          <span
                            class="
                              inline-flex
                              font-sans font-bold
                              uppercase
                              text-xxs
                              tracking-wide
                              text-gray-500
                            "
                            >patient name</span
                          >
                        </button>
                      </th>
                      <th
                        class="
                          text-left
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <button
                          type="button"
                          class="
                            cursor-pointer
                            inline-flex
                            items-center
                            focus:outline-none focus:ring
                            ring-primary-200
                            dark:ring-gray-600
                            rounded
                          "
                          dusk="sort-name"
                          aria-sort="none"
                        >
                          <span
                            class="
                              inline-flex
                              font-sans font-bold
                              uppercase
                              text-xxs
                              tracking-wide
                              text-gray-500
                            "
                            >Reason</span
                          >
                        </button>
                      </th>

                      <th
                        class="
                          text-left
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <button
                          type="button"
                          class="
                            cursor-pointer
                            inline-flex
                            items-center
                            focus:outline-none focus:ring
                            ring-primary-200
                            dark:ring-gray-600
                            rounded
                          "
                          dusk="sort-email"
                          aria-sort="none"
                        >
                          <span
                            class="
                              inline-flex
                              font-sans font-bold
                              uppercase
                              text-xxs
                              tracking-wide
                              text-gray-500
                            "
                            >appointment date</span
                          >
                        </button>
                      </th>
                      <th
                        class="
                          text-left
                          px-2
                          whitespace-nowrap
                          uppercase
                          text-gray-500 text-xxs
                          tracking-wide
                          py-2
                        "
                      >
                        <button
                          type="button"
                          class="
                            cursor-pointer
                            inline-flex
                            items-center
                            focus:outline-none focus:ring
                            ring-primary-200
                            dark:ring-gray-600
                            rounded
                          "
                          dusk="sort-email"
                          aria-sort="none"
                        >
                          <span
                            class="
                              inline-flex
                              font-sans font-bold
                              uppercase
                              text-xxs
                              tracking-wide
                              text-gray-500
                            "
                            >booking date</span
                          >
                        </button>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      dusk="1-row"
                      class="group"
                      v-for="(item, index) in appointmentsTable"
                      :key="index"
                    >
                      <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <span class="hidden">Resource</span>
                      </td>
                      <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <div class="text-left">
                          <a class="link-default" href="javascript:void(0)">{{
                            item.id
                          }}</a>
                        </div>
                      </td>
                        <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <div
                          class="items-center justify-center flex text-center"
                          resource="[object Object]"
                        >
                         <img
                            :src="
                              item.practitioner_image
                                ? item.practitioner_image
                                : 'https://www.gravatar.com/avatar/91877a2c1027667fd8f5c470e14a31a6?s=300'
                            "
                            class="inline-block rounded-full"
                            draggable="false"
                            style="max-width: 30px"
                          />
                        </div>
                      </td>
                       <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <div
                          class="items-center justify-center flex text-center"
                          resource="[object Object]"
                        >
                         <span class="text-90 whitespace-nowrap">{{
                            item.practitioner_name
                          }}</span>
                        </div>
                      </td>
                      <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <div
                          class="items-center justify-center flex text-center"
                          resource="[object Object]"
                        >
                          <img
                            :src="
                              item.patient_image_url
                                ? item.patient_image_url
                                : 'https://www.gravatar.com/avatar/91877a2c1027667fd8f5c470e14a31a6?s=300'
                            "
                            class="inline-block rounded-full"
                            draggable="false"
                            style="max-width: 30px"
                          />
                        </div>
                      </td>
                      <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <div class="text-left" resource="[object Object]">
                          <span class="text-90 whitespace-nowrap">{{
                            item.patient_name
                          }}</span>
                        </div>
                      </td>
                      <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <div class="text-left" resource="[object Object]">
                          <span class="text-90 whitespace-nowrap">{{
                            item.reason ? item.reason : "....."
                          }}</span>
                        </div>
                      </td>

                      <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <div class="text-left" resource="[object Object]">
                          <span class="text-90 whitespace-nowrap">{{
                            readAbleDateTime(item.start_time)
                          }}</span>
                        </div>
                      </td>
                      <td
                        class="
                          px-2
                          py-2
                          border-t border-gray-100
                          dark:border-gray-700
                          whitespace-nowrap
                          cursor-pointer
                          dark:bg-gray-800
                          group-hover:bg-gray-50
                          dark:group-hover:bg-gray-900
                        "
                      >
                        <div class="text-left" resource="[object Object]">
                          <span class="text-90 whitespace-nowrap">{{
                            readAbleDateTime(item.created_at)
                          }}</span>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <nav
                  class="
                    flex
                    items-center
                    justify-between
                    border-t border-gray-200
                    bg-white
                    dark:bg-gray-800
                    px-4
                    py-3
                    sm:px-6
                  "
                  aria-label="Pagination"
                >
                  <div class="hidden sm:block">
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                      Showing
                      {{ " " }}
                      <span class="font-medium">{{
                        appointmentsTable.length
                      }}</span>
                      {{ " " }}
                      to
                      {{ " " }}
                      <span class="font-medium">{{ perPageTable }}</span>
                      {{ " " }}
                      of
                      {{ " " }}
                      <span class="font-medium">{{ totalResultTable }}</span>
                      {{ " " }}
                      results.
                      {{ " | " }}
                      <span class="font-medium">{{ currentPageTable }}</span>
                      {{ " " }}

                      {{ "page of " }}
                      <span class="font-medium">{{ totalTable }}</span>
                      pages
                      {{ " " }}
                    </p>
                  </div>
                  <div class="flex flex-1 justify-between sm:justify-end">
                    <a
                      href="#"
                      @click.prevent="PrevPage"
                      class="
                        relative
                        inline-flex
                        items-center
                        rounded-md
                        border border-gray-300
                        bg-white
                        px-4
                        py-2
                        text-sm
                        font-medium
                        text-gray-700
                        hover:bg-gray-50
                      "
                      v-if="currentPageTable > 1"
                      >Previous</a
                    >
                    <a
                      href="#"
                      @click.prevent="NextPage"
                      class="
                        relative
                        ml-3
                        inline-flex
                        items-center
                        rounded-md
                        border border-gray-300
                        bg-white
                        px-4
                        py-2
                        text-sm
                        font-medium
                        text-gray-700
                        hover:bg-gray-50
                      "
                      v-if="currentPageTable < totalTable"
                      >Next</a
                    >
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
         <div class=" absolute w-full h-full  top-0 left-0 z-40" @click="showReason = false;showPractitioner = false;showDate = false;" v-if="showReason || showPractitioner || showDate"></div>

  </div>
</template>

<script>
import { onMounted, onBeforeUnmount, ref, watch } from "vue";
import axios from "axios";
axios.defaults.baseURL = "https://api.dentally.co/v1/";
axios.defaults.headers.common["Authorization"] =
  "Bearer " + "VgcjQR3YAVYWgI-1CTh27ap-y4fyuokf8hwGNLmPZk0";

export default {
  setup() {
    const showPractitioner = ref(false);
    const showReason = ref(false);
    const showDate = ref(false);
    const observer = ref(null);
    const dark = ref(false);
    const appointments = ref([]);
    const appointmentsTable = ref([]);
    const totalTime = ref("00:00"); //15:02:10
    const options = ref({
      chart: {
        id: "vuechart-example",
      },
      xaxis: {
        categories: [],
      },
    });
    const series = ref([
      {
        name: "Appointments",
        data: [],
      },
    ]);
    const show = ref(false);
    const currentPage = ref(1);
    const perPage = ref(100);
    const totalPage = ref(1);
    const currentPageTable = ref(1);
    const perPageTable = ref(100);
    const totalTable = ref(0);
    const totalResultTable = ref(0);
    const FilterPeriode = ref([
      {
        name: "Today",
        value: 0,
        active: true,
      },
      {
        name: "Yeseterday",
        value: 1,
        active: false,
      },
      {
        name: "This Week",
        value: 6,
        active: false,
      },
      {
        name: "Last Week",
        value: 13,
        active: false,
      },
      {
        name: "This Month",
        value: 29,
        active: false,
      },
      {
        name: "Last Month",
        value: 59,
        active: false,
      },
      {
        name:"Last 30days",
        value: 30,
        active: false,
      },
      {
        name: "This Year",
        value: 364,
        active: false,
      },
      {
        name: "Last Year",
        value: 729,
        active: false,
      },
    ]);
    const PeriodeIndex = ref(0);
    const Resons = ref([
      {
        name: "Exam",
        value: "Exam",
      },
      {
        name: "New Consultation ",
        value: "New Consultation ",
      },
      {
        name: "Dr Affan Consultation New Patient Exam",
        value: "Dr Affan Consultation New Patient Exam",
      },
      {
        name: "Scale & Polish",
        value: "Scale & Polish",
      },
      {
        name: "Initial Hygiene",
        value: "Initial Hygiene",
      },
      {
        name: "Root Canal",
        value: "Root Canal",
      },
      {
        name: "Invisalign Fit",
        value: "Invisalign Fit",
      },
      {
        name: "Teeth Whitening",
        value: "Teeth Whitening",
      },
      {
        name: "Composite Bonding DO NOT BOOK MORE THAN 2 PER DAY FOR DR AFFAN",
        value: "Composite Bonding DO NOT BOOK MORE THAN 2 PER DAY FOR DR AFFAN",
      },
      {
        name: "Emergency",
        value: "Emergency",
      },
      {
        name: "Review Sessions",
        value: "Review Sessions",
      },
      {
        name: "TCO Discussions",
        value: "TCO Discussions",
      },
      {
        name: "DO NOT DELETE",
        value: "DO NOT DELETE",
      },
      {
        name: "Scan Appointment",
        value: "X-Ray Appointment",
      },
      {
        name: "Final Invisalign Review",
        value: "Final Invisalign Review",
      },
      {
        name: "Hygiene Review",
        value: "Hygiene Review",
      },
      {
        name: "Root Canal Treatment",
        value: "Root Canal Treatment",
      },
      {
        name: "White Composite Fillings",
        value: "White Composite Fillings",
      },
      {
        name: "Extraction",
        value: "Extraction",
      },
      {
        name: "Crown",
        value: "Crown",
      },
      {
        name: "Dental Bridge",
        value: "Dental Bridge",
      },
      {
        name: "Porcelain Veneers",
        value: "Porcelain Veneers",
      },
      {
        name: "Dental Bridge",
        value: "Dental Bridge",
      },
      {
        name: "Wax Up",
        value: "Wax Up",
      },
      {
        name: "Mouth Guards",
        value: "Mouth Guards",
      },
      {
        name: "Review",
        value: "Review",
      },
      {
        name: "Other",
        value: "Other",
      },
    ]);
    const SelectedResons = ref([]);
    const Practitioners = ref([]);
    const SelectedPractitioners = ref(null);
    const ExcludeResults = ref([
      "",
      null,
      'NOT AVAILABLE DO NOT DELETE',
      'DO NOT DELETE',
      'Other',
      '.....'
    ]);
    const chartRef = ref(null);
    onMounted(() => {
      dark.value = document.documentElement.classList.contains("dark");

      observer.value = new MutationObserver((records) => {
        records.forEach((record) => {
          dark.value = record.target.classList.contains("dark");
        });
      });

      observer.value.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ["class"],
        childList: false,
        characterData: false,
      });
    });

    const SelectAllResons = () => {
      Resons.value.forEach((item) => {
        SelectedResons.value.push(item.value);
      });
      currentPage.value = 1;
      loadPaginatedAppointments();
    };
    const SelectAllPractitioner = () => {
      Practitioners.value.forEach((item) => {
        SelectedPractitioners.value.push(item.id);
      });
      currentPage.value = 1;
      currentPageTable.value = 1;
      loadPaginatedAppointments();
    };
    const SelectNextPeriode = () => {
      FilterPeriode.value[PeriodeIndex.value].active = false;
      PeriodeIndex.value = PeriodeIndex.value + 1;
      if (PeriodeIndex.value > FilterPeriode.value.length - 1) {
        PeriodeIndex.value = 0;
      }
      FilterPeriode.value[PeriodeIndex.value].active = true;
      appointments.value = [];
      currentPage.value = 1;
      currentPageTable.value = 1;
      showDate.value = false;
      loadAppointments();
      loadPaginatedAppointments();
    };
    const SelectPrevPeriode = () => {
      FilterPeriode.value[PeriodeIndex.value].active = false;
      PeriodeIndex.value = PeriodeIndex.value - 1;
      if (PeriodeIndex.value < 0) {
        PeriodeIndex.value = FilterPeriode.value.length - 1;
      }
      FilterPeriode.value[PeriodeIndex.value].active = true;
      appointments.value = [];
     currentPage.value = 1;
      currentPageTable.value = 1;
      showDate.value = false;
      loadAppointments();
      loadPaginatedAppointments();
    };

    const SelectPeriode = (item) => {
      item.active = true;
      FilterPeriode.value.forEach((element, index) => {
        if (element.name != item.name) {
          element.active = false;
        } else {
          PeriodeIndex.value = index;
        }
      });
      appointments.value = [];
      currentPage.value = 1;
      showDate.value = false;
      loadAppointments();
      loadPaginatedAppointments();
    };

    const NextPage = () => {
      currentPageTable.value = currentPageTable.value + 1;
      if (currentPageTable.value > totalTable.value) {
        currentPageTable.value = totalTable.value;
      }
      loadPaginatedAppointments();
    };

    const PrevPage = () => {
      currentPageTable.value = currentPageTable.value - 1;
      if (currentPageTable.value < 1) {
        currentPageTable.value = 1;
      }
      loadPaginatedAppointments();
    };

    const loadAppointments = async () => {
      //  after = "2022-11-1"
      // before = "2022-11-30"
      show.value = false;
      let on = null;
      let before = null;
      let after = null;
      let periode = FilterPeriode.value[PeriodeIndex.value].value;
      on = new Date();
      //get this month appointments
      on = on.toISOString().split("T")[0];
      //get last month appointments
      before = new Date();
      if (periode === 1) {
        before.setDate(before.getDate() - 1);
      } else if (periode == 13) {
        before.setDate(before.getDate() - 6);
      } 
      else if(periode == 29){
        //this month appointments last day of the month
        before.setDate(0);
        //add month
        before.setMonth(before.getMonth() + 1); 
        //minus 1 day
        before.setDate(before.getDate() - 1);
      }
      else if(periode == 59){
          before.setDate(0);
      }
      else {
        before.setDate(before.getDate());
      }

      before = before.toISOString().split("T")[0];
      //get next month appointments
      after = new Date();
      //7 = week, 30 = month, 365 = year, 0 = all, 1 = day,
      if(periode == 29){
        after.setDate(1);
      }
      else if(periode == 59){
        //first day of the last month
        after.setDate(1);
        after.setMonth(after.getMonth() - 1);
      }
       else if(periode == 30){
         after.setDate(after.getDate() - 29);
      }
      else{
         after.setDate(after.getDate() - periode); // play with this number to get the appointments you want
      }
      after = after.toISOString().split("T")[0];

     

      const response = await axios.get(
        "appointments?&before=" +
          before +
          "&after=" +
          after +
          "&practitioner_id=" +
          SelectedPractitioners.value +
          "&per_page=" +
          perPage.value +
          "&page=" +
          currentPage.value
      );
      appointments.value = appointments.value.concat(
        response.data.appointments
      );
       if (SelectedResons.value.length > 0) {
        appointments.value = appointments.value.filter((item) => {
          return SelectedResons.value.includes(item.reason);
        });
        
      }

      totalPage.value = response.data.meta.total_pages;
      if (response.data.meta.current_page < response.data.meta.total_pages) {
        currentPage.value = response.data.meta.current_page + 1;
        loadAppointments();
      } else {
        if (ExcludeResults.value.length > 0) {
          appointments.value = appointments.value.filter((item) => {
            return !ExcludeResults.value.includes(item.reason);
          });
          appointments.value = appointments.value.filter((item) => {
           return !ExcludeResults.value.includes(item.patient_name);
          });
      }

        let grouped = null;
        if (periode === 0) {
          grouped = groupByDay(appointments.value, "start_time");
        } else if (periode === 1) {
          grouped = groupByDay(appointments.value, "start_time");
        } else if (periode === 6 || periode === 13) {
          grouped = groupByWeek(appointments.value, "start_time");
        } else if (periode === 29 || periode === 59 || periode == 30) {
          grouped = groupByMonth(appointments.value, "start_time");
        } else if (periode === 364 || periode === 729) {
          grouped = groupByYear(appointments.value, "start_time");
        }
        //filter resons

        // console.log(grouped);
        console.log(appointments);
        options.value.xaxis.categories = Object.keys(grouped);
        //console.log(options.value.xaxis.categories);
        series.value[0].data = Object.values(grouped).map(
          (item) => item.length
        );
        totalResultTable.value = appointments.value.length;
        getTotalTime();
        show.value = true;
      }
    };

    const loadPaginatedAppointments = async () => {
      let on = null;
      let before = null;
      let after = null;
      let periode = FilterPeriode.value[PeriodeIndex.value].value;
      on = new Date();
      //get this month appointments
      on = on.toISOString().split("T")[0];
      //get last month appointments
      before = new Date();
      if (periode === 1) {
        before.setDate(before.getDate() - 1);
      } else if (periode == 13) {
        before.setDate(before.getDate() - 6);
      }

       else if(periode == 29){
        //this month appointments last day of the month
        before.setDate(0);
        //add month
        before.setMonth(before.getMonth() + 1); 
        //minus 1 day
        before.setDate(before.getDate() - 1);
      }
      else if(periode == 59){
          before.setDate(0);
      }
      else {
        before.setDate(before.getDate());
      }

      before = before.toISOString().split("T")[0];
      //get next month appointments
      after = new Date();
      //7 = week, 30 = month, 365 = year, 0 = all, 1 = day,
        if(periode == 29){
        after.setDate(1);
      }
      else if(periode == 59){
        //first day of the last month
        after.setDate(1);
        after.setMonth(after.getMonth() - 1);
      }
       else if(periode == 30){
         after.setDate(after.getDate() - 29);
      }
      else{
         after.setDate(after.getDate() - periode); // play with this number to get the appointments you want
      }
      after = after.toISOString().split("T")[0];

      const response = await axios.get(
        "appointments?&before=" +
          before +
          "&after=" +
          after +
          "&practitioner_id=" +
          SelectedPractitioners.value +
          "&per_page=" +
          perPageTable.value +
          "&page=" +
          currentPageTable.value
      );
      appointmentsTable.value = response.data.appointments;
      //appointmentsTable = filtered by SelectedResons and
      if (SelectedResons.value.length > 0) {
        appointmentsTable.value = appointmentsTable.value.filter((item) => {
          return SelectedResons.value.includes(item.reason);
        });
      }


      //ExcludeResults in appointmentsTable Resions and patient_name
      if (ExcludeResults.value.length > 0) {
        appointmentsTable.value = appointmentsTable.value.filter((item) => {
          return !ExcludeResults.value.includes(item.reason);
        });
        appointmentsTable.value = appointmentsTable.value.filter((item) => {
          return !ExcludeResults.value.includes(item.patient_name);
        });
      }
      
      //add Practitioner name to appointmentsTable when appointmentsTable.practitioner_id = practitioners.id
      appointmentsTable.value.forEach((item) => {
        item.practitioner_name = Practitioners.value.find(
          (practitioner) => practitioner.id === item.practitioner_id
        ).user.first_name;
      });

      //add image to appointmentsTable when appointmentsTable.patient_id = patients.id
      appointmentsTable.value.forEach((item) => {
        item.practitioner_image = Practitioners.value.find(
          (practitioner) => practitioner.id === item.practitioner_id
        ).user.image_url;
      });
      totalTable.value = response.data.meta.total_pages;
      console.log("dd", response.data);
    };

    const loadPractitioners = async () => {
      const response = await axios
        .get("practitioners?per_page=100")
        .then((response) => {
          Practitioners.value = response.data.practitioners;
          console.log(response.data);
        });
    };

    const displayMonthAndDay = (date) => {
      var d = new Date(date);
      var month = d.getMonth() + 1;
      var day = d.getDate();
      return month + "/" + day;
    };
    const displayTime = (date) => {
      //return time with AM/PM
      var d = new Date(date);
      var hours = d.getHours();
      var minutes = d.getMinutes();
      var ampm = hours >= 12 ? "PM" : "AM";
      hours = hours % 12;
      hours = hours ? hours : 12; // the hour '0' should be '12'
      minutes = minutes < 10 ? "0" + minutes : minutes;
      var strTime = hours + ":" + minutes + " " + ampm;
      // add month and day

      return strTime + " /" + displayMonthAndDay(date);
    };

    const displayMonthandYear = (date) => {
      var d = new Date(date);
      var month = d.getMonth() + 1;
      var year = d.getFullYear();
      return month + "/" + year;
    };

    const displayDayname = (date) => {
      var days = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
      ];
      var d = new Date(date);
      var dayName = days[d.getDay()];
      return dayName + "/" + displayMonthAndDay(date);
    };

    const groupByWeek = (xs, key) => {
      return xs.reduce((rv, x) => {
        (rv[displayDayname(x[key])] = rv[displayDayname(x[key])] || []).push(x);
        return rv;
      }, {});
    };

    const groupByMonth = (xs, key) => {
      return xs.reduce((rv, x) => {
        (rv[displayMonthAndDay(x[key])] =
          rv[displayMonthAndDay(x[key])] || []).push(x);
        return rv;
      }, {});
    };

    const groupByYear = (xs, key) => {
      //group by months of the year
      return xs.reduce((rv, x) => {
        (rv[displayMonthandYear(x[key])] =
          rv[displayMonthandYear(x[key])] || []).push(x);
        return rv;
      }, {});
    };

    const getTotalTime = () => {
      //get total time of all appointments 15:02:10
      // let time = 0;
      // appointments.value.forEach((item) => {
      //   let total = item.start_time; // 2022-10-19T08:00:00.000+01:00
      //   total = total.split("T")[1]; // 08:00:00.000+01:00
      //   total = total.split(":"); // [08, 00, 00.000+01, 00]
      //   total = total[0] * 60 + total[1] * 1; // 480
      //   time += total;
      // });
      // let hours = Math.floor(time / 60);
      // let minutes = time % 60;
      // totalTime.value = hours + "H:" + minutes + "M";

      //get total time of all appointments 15:02:10
      let time = 0;
      let start_time = 0;
      let end_time = 0;
      appointments.value.forEach((item) => {
        let total = item.start_time; // 2022-10-19T08:00:00.000+01:00
        total = total.split("T")[1]; // 08:00:00.000+01:00
        total = total.split(":"); // [08, 00, 00.000+01, 00]
        start_time = total[0] * 60 + total[1] * 1; // 480

        let total2 = item.finish_time; // 2022-10-19T08:00:00.000+01:00
        total2 = total2.split("T")[1]; // 08:00:00.000+01:00
        total2 = total2.split(":"); // [08, 00, 00.000+01, 00]
        end_time = total2[0] * 60 + total2[1] * 1; // 480

        time += end_time - start_time;
        
      });
      let hours = Math.floor(time / 60);
      let minutes = time % 60;
      totalTime.value = hours + "H:" + minutes + "M";
    };

    const groupByDay = (xs, key) => {
      //group by day time 24h and display it like time / day/ month
      return xs.reduce((rv, x) => {
        (rv[displayTime(x[key])] = rv[displayTime(x[key])] || []).push(x);
        return rv;
      }, {});
    };

    const readAbleDateTime = (date) => {
      //date = 2022-10-06T07:00:00.000+01:00
      let d = new Date(date);
      let day = d.getDate();
      let month = d.getMonth() + 1;
      let year = d.getFullYear();
      let hours = d.getHours();
      let minutes = d.getMinutes();
      let ampm = hours >= 12 ? "PM" : "AM";
      hours = hours % 12;
      hours = hours ? hours : 12; // the hour '0' should be '12'
      minutes = minutes < 10 ? "0" + minutes : minutes;
      var strTime = hours + ":" + minutes + " " + ampm;
      return strTime + " /" + day + "/" + month + "/" + year;
    };

    const dataURL = () => {

    }

    //watch SelectedResons to get the appointments
    watch(
      () => [SelectedResons.value, PeriodeIndex.value],
      async () => {
        console.log(
          "watching - " + SelectedResons.value + " - " + PeriodeIndex.value
        );
         appointments.value = [];
      currentPage.value = 1;
      currentPageTable.value = 1;
        await loadPaginatedAppointments();
         await loadAppointments();
        // getTotalTime();
      }
    );
    watch(
      () => [SelectedPractitioners.value, PeriodeIndex.value],
      async () => {
        console.log(
          "watching - " +
            SelectedPractitioners.value +
            " - " +
            PeriodeIndex.value
        );
        appointments.value = [];
      currentPage.value = 1;
      currentPageTable.value = 1;
        await loadPaginatedAppointments();
        await loadAppointments();
        // getTotalTime();
      }
    );

    onMounted(() => {
       loadPractitioners();
      loadAppointments();
      loadPaginatedAppointments();
    });

    onBeforeUnmount(() => {
      observer.value.disconnect();
    });

    return {
      dark,
      appointments,
      options,
      series,
      show,
      FilterPeriode,
      PeriodeIndex,
      SelectNextPeriode,
      SelectPrevPeriode,
      SelectPeriode,
      showPractitioner,
      showReason,
      showDate,
      currentPage,
      totalPage,
      appointmentsTable,
      currentPageTable,
      perPageTable,
      totalTable,
      NextPage,
      PrevPage,
      totalResultTable,
      totalTime,
      readAbleDateTime,
      Resons,
      SelectedResons,
      SelectAllResons,
      Practitioners,
      SelectedPractitioners,
      chartRef
    };
  },
};
</script>

<style>
/* Scoped Styles */
</style>
