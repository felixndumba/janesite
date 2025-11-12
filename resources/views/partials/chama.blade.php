 <div class=" h-fumax-w-7xl mx-auto px-6 bg-[#f9f7f4] rounded-lg shadow-lg">
    <h3 class="text-2xl font-bold text-[#924c2e]">Chama Package</h3>
    <p class="text-gray-600 mt-2">Specialized financial guidance for investment groups and chamas.</p><br>

    <ul class="list-none pl-5 text-gray-700 space-y-2">
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> One session
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Discovery session
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Goal setting session
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Money personalities exercise
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Aligning your goals with available investments
        </li>
        <li class="flex items-center gap-3 text-lg">
            <span class="text-[#c45b1f]">•</span> Credit options
        </li>
    </ul>
    
    <p class="text-gray-600 mt-4">Kindly note this is an online session and an additional facilitation fee applies for physical sessions.</p>

    <div class="mt-6 p-4 bg-gray-100 rounded-md">
        <h4 class="font-bold text-gray-900">Pricing Structure</h4>
        <p class="text-gray-700">9,500 KSH for groups less than 10 | 1,500 KSH per person for groups above 10</p>
    </div>

    <div class="mt-4 flex space-x-4">
       <button class="w-1/2 bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638] transition duration-300" onclick="openPaymentModal('Chama Small Group Package', '1')">
            Book for Small Group (<10)
        </button>
        <div class="w-1/2">
        <input 
            id="groupSizeInput"
            type="number" 
            min="11" 
            placeholder="Enter number of people (≥11)" 
            class="border rounded-lg p-2 w-full mb-2 focus:ring-2 focus:ring-orange-400 focus:border-orange-500 outline-none shadow-sm"
        />
        <button 
            class="w-full bg-[#b25d4c] text-white font-semibold py-3 rounded-lg hover:bg-[#8a4638] transition duration-300"
            onclick="handleLargeGroupBooking()">
            Book for Large Group (>10)
        </button>
    </div>
    </div>

    <script>
        function handleLargeGroupBooking() {
            const groupSize = document.getElementById('groupSizeInput').value;
            
            // Validate that input is a number and greater than 10
            if (groupSize && groupSize > 10) {
                const amount = groupSize * 1500; // Calculate total amount (1500 KSH per person)
                openPaymentModal('Chama Large Group Package', amount);
            } else {
                alert('Please enter a valid number greater than 10 for large group booking.');
            }
        }
    </script>
</div>
