
        /*
         * In this example we will only customize the document's scrolling,
         * but the API fully support every custom scrollable container
         */
        function init() {
            /* 
             * We tell the API which element is the one that scrolls the document
             * (useful whenever it's something like the body element, a custom container,
             * a framework specific container, etc...)
             */
            uss.setPageScroller(window);

            /** 
             * This API function, enables the anchors' 
             * smooth-scrolling to the corresponding section
             */
            uss.hrefSetup();

            /** 
             * This version would prevent the stop-and-go effect you have when 
             * you click the same anchor more than one time.
             */
            //uss.hrefSetup(null, null, () => {return !uss.isScrolling();});

            /**
             * This API function, sets the easing of the pageScroller (that we set to window) to a
             * medium speed(the "QUART" part) ease-in-out function that last exactly 1 second.
             */
            //uss.setStepLengthCalculator(EASE_IN_OUT_QUART(1000));

            /**
             * This API function allow us to stop the scrolling on a container.
             * In this case, we don't want any more scrolling 
             * if the user scrolls the document with the mousewheel.
             */
            window.addEventListener(
                "wheel",
                () => uss.stopScrolling()
            );
        }