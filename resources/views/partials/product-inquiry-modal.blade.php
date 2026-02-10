<!-- PRODUCT INQUIRY MODAL -->
<div id="productModal"
      class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm
            flex items-center justify-center z-[9999]
            overflow-y-auto px-4 transition-opacity duration-300">

    <div id="productCard"
         class="mx-auto bg-white rounded-3xl p-6 w-full max-w-md
                shadow-2xl transform scale-95 opacity-0 transition-all duration-300
                max-h-[calc(100vh-200px)] overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-5">
            <h4 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                Product Inquiry
            </h4>
            <button onclick="closeProductModal()"
                    class="text-gray-400 text-left hover:text-gray-700 text-lg font-bold">✕</button>
        </div>

        <!-- Form -->
        <form id="productForm" class="space-y-3">
            @csrf
            <input type="hidden" name="product" id="modalProduct">

            <div>
                <label class="text-sm mt-2 font-medium text-gray-700">Selected Product</label>
                <input type="text" id="modalProductDisplay" readonly
                       class="w-full mt-1 px-5 py-2 border rounded-xl bg-gray-50">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Name *</label>
                <input type="text" name="name" required
                       class="w-full mt-1 px-5 py-2 border rounded-xl focus:ring-2 focus:ring-[#a04f3f]">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Email *</label>
                <input type="email" name="email" id="product-email" required
                       class="w-full mt-1 px-5 py-2 border rounded-xl focus:ring-2 focus:ring-[#a04f3f]">
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                <div id="product-email-error" class="text-red-500 text-sm mt-1 hidden">Please enter a valid Gmail address (e.g., example@gmail.com).</div>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone"
                       class="w-full mt-1 px-5 py-2 border rounded-xl focus:ring-2 focus:ring-[#a04f3f]">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Message *</label>
                <textarea rows="3" name="message" required
                          class="w-full mt-1 px-5 py-2 border rounded-xl focus:ring-2 focus:ring-[#a04f3f]"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
               
                <button type="submit"
                        class="px-4 w-full py-2 rounded-xl bg-[#a04f3f] text-white hover:bg-[#8b3f33]">
                    Send Inquiry
                </button>
            </div>
        </form>
    </div>
</div>

<!-- BRANDED SUCCESS CTA -->
<div id="successCTA"
     class="hidden fixed inset-0 bg-black/40 z-50
            flex items-center justify-center px-4">

    <div class="bg-white rounded-3xl p-8 max-w-md w-full text-center
                shadow-2xl transform scale-95 opacity-0 transition-all duration-300">

        <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-[#a04f3f]/10
                    flex items-center justify-center">
            
        </div>

        <h3 class="text-xl font-bold text-gray-800">
            Thank you for reaching out
        </h3>

        <p class="text-gray-600 mt-2">
            We’ve received your inquiry and will get back to you as soon as possible, typically
            <span class="font-semibold text-[#a04f3f]">within 24 hours</span>.
        </p>

        <button onclick="closeSuccessCTA()"
                class="mt-6 px-6 py-2 rounded-full bg-[#a04f3f]
                       text-white hover:bg-[#8b3f33] transition">
            Close
        </button>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("productModal");
    const card = document.getElementById("productCard");
    const successCTA = document.getElementById("successCTA");
    const form = document.getElementById("productForm");

    /* ================= OPEN PRODUCT MODAL ================= */
    function openProductModal(product) {
        document.getElementById("modalProduct").value = product;
        document.getElementById("modalProductDisplay").value = product;

        modal.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");

        setTimeout(() => {
            card.classList.remove("scale-95","opacity-0");
            card.classList.add("scale-100","opacity-100");
        }, 10);
    }

    /* ================= CLOSE PRODUCT MODAL ================= */
    function closeProductModal() {
        card.classList.add("scale-95","opacity-0");
        card.classList.remove("scale-100","opacity-100");

        setTimeout(() => {
            modal.classList.add("hidden");
            document.body.classList.remove("overflow-hidden");
        }, 200);
    }

    /* ================= SUCCESS CTA ================= */
    function openSuccessCTA() {
        successCTA.classList.remove("hidden");

        const card = successCTA.querySelector("div");
        card.classList.add("scale-95","opacity-0");

        setTimeout(() => {
            card.classList.remove("scale-95","opacity-0");
            card.classList.add("scale-100","opacity-100");
        }, 10);
    }

    window.closeSuccessCTA = () => {
        successCTA.classList.add("hidden");
    };

    /* ================= SELECT BUTTON HANDLER ================= */
    document.addEventListener("click", (e) => {
        const btn = e.target.closest(".select-product");
        if (!btn) return;

        const product = btn.dataset.product;
        if (!product) return;

        openProductModal(product);
    });

    /* ================= CLOSE EVENTS ================= */
    modal.addEventListener("click", (e) => {
        if (!card.contains(e.target)) closeProductModal();
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            closeProductModal();
            closeSuccessCTA();
        }
    });

    /* ================= FORM SUBMIT ================= */
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        fetch("{{ route('product.inquiry') }}", {
            method: "POST",
            body: new FormData(form),
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                closeProductModal();
                openSuccessCTA();
                form.reset();
            } else {
                alert("Something went wrong. Please try again.");
            }
        })
        .catch(() => alert("Network error. Please try again."));
    });

    /* ================= EXPOSE CLOSE ================= */
    window.closeProductModal = closeProductModal;
});
</script>
