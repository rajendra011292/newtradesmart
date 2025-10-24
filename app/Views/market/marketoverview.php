
  <div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <header class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <h1 class="text-xl font-semibold tracking-tight">Bias (Baise) — 5 Section Overview</h1>
      <div class="flex flex-wrap items-center gap-2">
        <span class="px-3 py-1 rounded-full text-xs bg-slate-800 ring-1 ring-slate-700 text-slate-300">Manual Entry</span>
        <label class="px-3 py-1 rounded-full text-xs bg-slate-800 ring-1 ring-slate-700 text-slate-300 flex items-center gap-2">
          <span>Date:</span>
          <input class="bg-transparent focus:outline-none placeholder-slate-500" value="Fri, 24 Oct 2025"/>
        </label>
      </div>
    </header>

    <!-- SECTION 1: Market Direction & Strength -->
    <section id="section1" class="mt-6">
      <h2 class="uppercase text-[11px] tracking-widest text-slate-400 mb-2">1) Market Direction & Strength</h2>
      <div class="bg-panel/80 ring-1 ring-slate-700 rounded-2xl p-4">
        <div class="text-sm text-slate-400 font-medium mb-3">Trend • Support/Resistance • Momentum • Volatility</div>
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3">
          <!-- Nifty -->
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">Nifty 50 (Spot)</div>
            <div class="mt-1 flex items-center gap-2 text-lg font-semibold">
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 text-right w-32" value="19845"/>
              <span class="text-up">▲</span>
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 text-right w-20" value="0.65%"/>
            </div>
            <div class="mt-1 text-xs text-slate-400">Trend note:
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 w-44" value="Above 20/50 EMA"/>
            </div>
            <div class="mt-2 h-8 rounded-md border border-dashed border-slate-700 bg-slate-900"></div>
          </div>
          <!-- Bank Nifty -->
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">Bank Nifty</div>
            <div class="mt-1 flex items-center gap-2 text-lg font-semibold">
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 text-right w-32" value="43120"/>
              <span class="text-down">▼</span>
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 text-right w-20" value="0.24%"/>
            </div>
            <div class="mt-1 text-xs text-slate-400">Note:
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 w-44" value="Near support 42,900"/>
            </div>
            <div class="mt-2 h-8 rounded-md border border-dashed border-slate-700 bg-slate-900"></div>
          </div>
          <!-- Momentum -->
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">Momentum (RSI / MACD)</div>
            <div class="mt-1 flex items-center gap-2 text-lg font-semibold">
              <span class="text-slate-300">RSI</span>
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 text-right w-16" value="62"/>
              <span class="text-slate-400 text-sm">• MACD:</span>
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 w-32" value=">0, rising"/>
            </div>
            <div class="mt-2 h-8 rounded-md border border-dashed border-slate-700 bg-slate-900"></div>
          </div>
          <!-- VIX -->
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">India VIX</div>
            <div class="mt-1 flex items-center gap-2 text-lg font-semibold">
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 text-right w-20" value="11.2"/>
              <span class="text-down">▼</span>
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 text-right w-20" value="3.1%"/>
            </div>
            <div class="mt-1 text-xs text-slate-400">Vol note:
              <input class="bg-transparent border border-slate-700 rounded-md px-2 py-1 w-56" value="Low vols support trend"/>
            </div>
            <div class="mt-2 h-8 rounded-md border border-dashed border-slate-700 bg-slate-900"></div>
          </div>
        </div>
        <!-- Key levels & notes -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400 mb-2">Key Levels</div>
            <div class="overflow-hidden rounded-xl ring-1 ring-slate-800">
              <table class="w-full text-sm">
                <thead class="bg-slate-800/60 text-slate-300">
                  <tr>
                    <th class="text-left px-3 py-2">Index</th>
                    <th class="text-left px-3 py-2">Support</th>
                    <th class="text-left px-3 py-2">Resistance</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                  <tr>
                    <td class="px-3 py-2">Nifty</td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="19700"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="19950"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2">BankNifty</td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="42900"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="43600"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2">Nifty Midcap</td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="15350"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="15780"/></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400 mb-2">Price Action Notes</div>
            <ul class="space-y-2 text-sm">
              <li><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Breakouts holding above swing"/></li>
              <li><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Pullbacks bought w/ volume"/></li>
              <li><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Watch for gap exhaustion"/></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 2: Institutional Flow Confirmation -->
    <section id="section2" class="mt-6">
      <h2 class="uppercase text-[11px] tracking-widest text-slate-400 mb-2">2) Institutional Flow Confirmation</h2>
      <div class="bg-panel/80 ring-1 ring-slate-700 rounded-2xl p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">FII / DII (₹ Cr)</div>
            <div class="mt-1 flex items-center gap-2 text-lg font-semibold">
              <span class="text-up">FII</span>
              <input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20 text-right" value="+850"/>
              <span class="text-slate-500">/</span>
              <span class="text-down">DII</span>
              <input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20 text-right" value="-400"/>
            </div>
            <div class="mt-1 text-xs text-slate-400">Weekly: FII <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-20 text-right" value="+2300"/> • DII <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-20 text-right" value="-1200"/></div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">Market Breadth</div>
            <div class="mt-1 text-lg font-semibold flex items-center gap-2">
              <span>Adv</span><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20 text-right" value="1200"/>
              <span>Dec</span><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20 text-right" value="980"/>
              <span>Unch</span><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20 text-right" value="300"/>
            </div>
            <div class="mt-1 text-xs text-slate-400">Breadth Ratio <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-20 text-right" value="1.22"/></div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">Derivatives (PCR / Max Pain)</div>
            <div class="mt-1 text-lg font-semibold flex items-center gap-2">
              <span>PCR</span><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20 text-right" value="1.12"/>
            </div>
            <div class="mt-1 text-xs text-slate-400">Max Pain: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-24 text-right" value="19800"/> • OI note: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-40" value="19,800C / 19,700P"/></div>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 3: Earnings & Sector Sentiment -->
    <section id="section3" class="mt-6">
      <h2 class="uppercase text-[11px] tracking-widest text-slate-400 mb-2">3) Earnings & Sector Sentiment</h2>
      <div class="bg-panel/80 ring-1 ring-slate-700 rounded-2xl p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3">
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">PSU Banks</div>
            <div class="mt-1 text-lg font-semibold text-up"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="+2.3%"/></div>
            <div class="text-xs text-slate-400">Leaders: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-40" value="SBIN, PNB"/></div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">Metals</div>
            <div class="mt-1 text-lg font-semibold text-up"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="+1.9%"/></div>
            <div class="text-xs text-slate-400">Leaders: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-44" value="TATASTEEL, HINDALCO"/></div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">IT</div>
            <div class="mt-1 text-lg font-semibold text-up"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="+1.2%"/></div>
            <div class="text-xs text-slate-400">Leader: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-28" value="INFY"/></div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">Auto</div>
            <div class="mt-1 text-lg font-semibold text-down"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="-0.6%"/></div>
            <div class="text-xs text-slate-400">Laggards: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-44" value="HEROMOTOCO, MARUTI"/></div>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400 mb-2">Top Gainers</div>
            <div class="overflow-hidden rounded-xl ring-1 ring-slate-800">
              <table class="w-full text-sm">
                <thead class="bg-slate-800/60 text-slate-300">
                  <tr>
                    <th class="text-left px-3 py-2">Stock</th>
                    <th class="text-left px-3 py-2">%</th>
                    <th class="text-left px-3 py-2">Vol</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="TATASTEEL"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="+4.8%"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24" value="42.1M"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="SBIN"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="+3.9%"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24" value="28.7M"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="HINDALCO"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="+3.2%"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24" value="19.4M"/></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400 mb-2">Earnings</div>
            <div class="overflow-hidden rounded-xl ring-1 ring-slate-800">
              <table class="w-full text-sm">
                <thead class="bg-slate-800/60 text-slate-300">
                  <tr>
                    <th class="text-left px-3 py-2">Company</th>
                    <th class="text-left px-3 py-2">Result</th>
                    <th class="text-left px-3 py-2">Note</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="TCS"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24" value="Beat"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Margin expansion"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="HDFCBANK"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24" value="Inline"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Provisions higher"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="MARUTI"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24" value="Miss"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Soft guidance"/></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 4: Macro & Global Environment -->
    <section id="section4" class="mt-6">
      <h2 class="uppercase text-[11px] tracking-widest text-slate-400 mb-2">4) Macro & Global Environment</h2>
      <div class="bg-panel/80 ring-1 ring-slate-700 rounded-2xl p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3">
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">USD/INR</div>
            <div class="mt-1 text-lg font-semibold"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-28 text-right" value="83.10"/></div>
            <div class="text-xs text-slate-400">Stance: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-28" value="Stable"/></div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">Brent Crude</div>
            <div class="mt-1 text-lg font-semibold text-down"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32 text-right" value="$82.4"/></div>
            <div class="text-xs text-slate-400">Note: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-32" value="Softening"/></div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">US 10Y Yield</div>
            <div class="mt-1 text-lg font-semibold"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-28 text-right" value="4.15%"/></div>
            <div class="text-xs text-slate-400">Note: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-28" value="Neutral"/></div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400">S&P 500 (Fut)</div>
            <div class="mt-1 text-lg font-semibold text-up"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-28 text-right" value="+0.4%"/></div>
            <div class="text-xs text-slate-400">Note: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-36" value="Risk-on cues"/></div>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400 mb-2">Global Snapshot</div>
            <div class="overflow-hidden rounded-xl ring-1 ring-slate-800">
              <table class="w-full text-sm">
                <thead class="bg-slate-800/60 text-slate-300">
                  <tr>
                    <th class="text-left px-3 py-2">Index</th>
                    <th class="text-left px-3 py-2">%</th>
                    <th class="text-left px-3 py-2">Comment</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="Dow"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="+0.3%"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Earnings support"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="FTSE"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="-0.2%"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Energy drags"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-32" value="Nikkei"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-24 text-right" value="+0.6%"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Weak yen tailwind"/></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400 mb-2">Notes</div>
            <ul class="space-y-2 text-sm">
              <li><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Soft crude + stable INR is supportive"/></li>
              <li><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Watch US yields > 4.3% for risk-off shift"/></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 5: Calendar & Market Events -->
    <section id="section5" class="mt-6">
      <h2 class="uppercase text-[11px] tracking-widest text-slate-400 mb-2">5) Calendar & Market Events</h2>
      <div class="bg-panel/80 ring-1 ring-slate-700 rounded-2xl p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400 mb-2">This Week</div>
            <div class="overflow-hidden rounded-xl ring-1 ring-slate-800">
              <table class="w-full text-sm">
                <thead class="bg-slate-800/60 text-slate-300">
                  <tr>
                    <th class="text-left px-3 py-2">Date</th>
                    <th class="text-left px-3 py-2">Event</th>
                    <th class="text-left px-3 py-2">Note</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20" value="Mon"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Results: TCS"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Earnings call 5:30 PM"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20" value="Tue"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="IPO Opens"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Midcap consumer"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20" value="Thu"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="F&O Expiry"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Expect volatility"/></td>
                  </tr>
                  <tr>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-20" value="Fri"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="RBI Speech"/></td>
                    <td class="px-3 py-2"><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Liquidity cues"/></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="rounded-xl bg-slate-900/60 ring-1 ring-slate-800 p-3">
            <div class="text-xs text-slate-400 mb-2">Playbook / Risk</div>
            <ul class="space-y-2 text-sm">
              <li><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Trend intact above Nifty 19,700"/></li>
              <li><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Reduce size near expiry day"/></li>
              <li><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="Hedge if VIX > 14"/></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- FINAL BIAS SUMMARY -->
    <section id="summary" class="mt-6">
      <h2 class="uppercase text-[11px] tracking-widest text-slate-400 mb-2">Bias Summary (Derived)</h2>
      <div class="bg-panel/80 ring-1 ring-slate-700 rounded-2xl p-4">
        <div class="flex flex-wrap gap-2 text-sm">
          <span class="px-2.5 py-1 rounded-lg ring-1 ring-slate-700 bg-slate-900/60">1) Direction: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-28" value="Positive"/></span>
          <span class="px-2.5 py-1 rounded-lg ring-1 ring-slate-700 bg-slate-900/60">2) Flows: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-36" value="Mildly Positive"/></span>
          <span class="px-2.5 py-1 rounded-lg ring-1 ring-slate-700 bg-slate-900/60">3) Earnings/Sectors: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-28" value="Positive"/></span>
          <span class="px-2.5 py-1 rounded-lg ring-1 ring-slate-700 bg-slate-900/60">4) Macro/Global: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-28" value="Supportive"/></span>
          <span class="px-2.5 py-1 rounded-lg ring-1 ring-slate-700 bg-slate-900/60">5) Events: <input class="bg-transparent border border-slate-700 rounded px-2 py-0.5 w-28" value="Expiry risk"/></span>
        </div>
        <p class="mt-3 text-sm">Overall Bias: <b><input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-44" value="Cautiously Bullish"/></b> — Rationale: <input class="bg-transparent border border-slate-700 rounded px-2 py-1 w-full" value="4/5 supportive; manage risk around F&O expiry"/>
        </p>
      </div>
    </section>

    <!-- Quick Nav -->
    <nav class="fixed bottom-6 right-6 hidden sm:flex flex-col gap-2">
      <a href="#section1" class="px-3 py-2 rounded-xl bg-slate-900/80 ring-1 ring-slate-700 text-xs hover:bg-slate-800">1</a>
      <a href="#section2" class="px-3 py-2 rounded-xl bg-slate-900/80 ring-1 ring-slate-700 text-xs hover:bg-slate-800">2</a>
      <a href="#section3" class="px-3 py-2 rounded-xl bg-slate-900/80 ring-1 ring-slate-700 text-xs hover:bg-slate-800">3</a>
      <a href="#section4" class="px-3 py-2 rounded-xl bg-slate-900/80 ring-1 ring-slate-700 text-xs hover:bg-slate-800">4</a>
      <a href="#section5" class="px-3 py-2 rounded-xl bg-slate-900/80 ring-1 ring-slate-700 text-xs hover:bg-slate-800">5</a>
    </nav>
  </div>
