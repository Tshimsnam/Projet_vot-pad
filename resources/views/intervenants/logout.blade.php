
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>

<div class="flex items-center h-full justify-center">
    <label for="" class="text-6xl text-gray-900 dark:text-white"> {{$message}}</label>
    <form action="{{route('inter.logout')}}" id="logout" method="get">
        @method('get')
        @csrf
        <label for="" id="element" class=""></label>
    </form>
</div>

<script>
        //script pour le chrono duree evaluation
        function paddedFormat(num) {
            return num < 10 ? '0' + num : num;
        }
        function startCountDown(duration, element) {
            let secondsRemaining = duration;
            let min = 0;
            let sec = 0;

            let countInterval = setInterval(function() {
                min = parseInt(secondsRemaining / 60);
                sec = parseInt(secondsRemaining % 60);

                const form =document.getElementById('logout');
                if(`${paddedFormat(min)}`== 0 && `${paddedFormat(sec)}`==0){
                    form.submit()
                }else{
                    console.log(`pas fini encore ${paddedFormat(min)} min - ${paddedFormat(sec)} sec`)
                }
               
                secondsRemaining = secondsRemaining - 1;
                if (secondsRemaining < 0) {
                    clearInterval(countInterval)
                };
            }, 1000);
        }

        window.onload = function() {
            let duration = 5;
            element = document.getElementById('#element');
            startCountDown(--duration, element);
        };
    </script>