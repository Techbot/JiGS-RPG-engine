window.onload = function () {
  var daleisa = [{id: "edu", labco: 0.7744, matco: 0.1, locpro: 0.1256, expro: 0, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "med", labco: 0.7044, matco: 0.13, locpro: 0.1656, expro: 0, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "bank", labco: 0.5044, matco: 0.15, locpro: 0.3456, expro: 0, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "hea", labco: 0.4344, matco: 0.35, locpro: 0.2156, expro: 0, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "ret", labco: 0.3944, matco: 0.45, locpro: 0.1056, expro: 0.05, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "manu", labco: 0.2944, matco: 0.4, locpro: 0.1556, expro: 0.15, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "infr", labco: 0.2044, matco: 0.68, locpro: 0.1156, expro: 0, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "agr", labco: 0.1444, matco: 0.7, locpro: 0.1056, expro: 0.05, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "nat", labco: 0.1044, matco: 0.5, locpro: 0.0956, expro: 0.3, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "rea", labco: 0.1244, matco: 0.65, locpro: 0.2256, expro: 0, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}, {id: "gov", labco: null, matco: null, locpro: null, expro: null, ownz: null, funz: null, incz: null, incz2: null, corz: null, corz2: null, impz: null, expz: null, consz: null, sectgdpprc: null, owfun1: null, owfun2: null, owfun3: null, owfun4: null, sectgdp: null, cortx: null, inctx: null, imptx: null, exptx: null, constx: null, pbinctx: null, pbcortx: null, prcx: null, wagx: null, wagrx: null, pexx: null}];
  var mohit = [{struc1: "Imperial", struc2: "", struc3: "World-State", struc4: "Anarcho-Imperialism", struc5: ""}, {struc1: "Unitary", struc2: "Syndicalist", struc3: "Nation-State", struc4: "Anarcho-Unitarism", struc5: "Anarcho-Syndicalism"}, {struc1: "Federal", struc2: "Technocratic", struc3: "City-State", struc4: "Anarcho-Federation", struc5: "Anarcho-Technocracy"}, {struc1: "Confederal", struc2: "Militaristic", struc3: "", struc4: "Anarcho-Confederation", struc5: "Armed Forces"}, {struc1: "Supranational", struc2: "Corporatist", struc3: "", struc4: "Individualist Anarchism", struc5: "Corporation"}, {struc1: "", struc2: "Theocratic", struc3: "", struc4: "", struc5: "Anarcho-Theocracy"}];
  var seleen = [{dirz: "Direct Democracy", elez: "Participatory Democracy", appz: "Participatory Democracy", exez: "Pure Democracy"}, {dirz: "Participatory Democracy", elez: "Presidential Republic", appz: "Semi-Presidential Republic", exez: "Dictatorial Republic"}, {dirz: "Participatory Democracy", elez: "Parliamental Republic", appz: "One-Party State", exez: "Dictatorial One Party State"}, {dirz: "Dynastic Participatory Democracy", elez: "Dynastic Parliamental Republic", appz: "Dynastic State", exez: "Dictatorial Dynastic State"}];
  var hamaad = [{dirz: "", elez: "", appz: "", exez: ""}, {dirz: "Participatory Republican Monarchy", elez: "Republican Monarchy", appz: "Republican Monarchy", exez: "Dictatorial Republican Monarchy"}, {dirz: "Participatory Monarchy", elez: "Parliamental Monarchy", appz: "Elective Monarchy", exez: "Dictatorial Elective Monarchy"}, {dirz: "Participatory Hereditary Monarchy", elez: "Parliamental Hereditary Monarchy", appz: "Hereditary Monarchy", exez: "Dictatorial Hereditary Monarchy"}];
  var kellon = [{chaz: "dist419/images/cha3.svg", linez: "dist419/images/line1.svg", lblz: "dist419/images/lblz.svg", shadz: "dist419/images/shad1.svg"}, {chaz: "dist419/images/cha2.svg", linez: "dist419/images/line3.svg", lblz: "", shadz: ""}, {chaz: "dist419/images/cha4.svg", linez: "dist419/images/line2.svg", lblz: "", shadz: ""}, {chaz: "dist419/images/cha1.svg", linez: "dist419/images/line4.svg", lblz: "", shadz: ""}, {chaz: "dist419/images/cha5.svg", linez: "", lblz: "", shadz: ""}];
  var avaeyah = [{valz: null, id: "sov"}, {valz: null, id: "auto"}, {valz: null, id: "govg"}, {valz: null, id: "govc"}, {valz: null, id: "syse"}, {valz: null, id: "sysl"}, {valz: null, id: "sysj"}, {valz: null, id: "rel"}, {valz: null, id: "for"}, {valz: null, id: "cons"}, {valz: null, id: "righ"}, {valz: null, id: "minw"}, {valz: null, id: "minw2"}, {valz: null, id: "pensreg"}, {valz: null, id: "centow"}, {valz: null, id: "murd"}, {valz: null, id: "rape"}, {valz: null, id: "steal"}, {valz: null, id: "child"}, {valz: null, id: "defa"}, {valz: null, id: "incit"}, {valz: null, id: "stprost"}, {valz: null, id: "broth"}, {valz: null, id: "esco"}, {valz: null, id: "hand"}, {valz: null, id: "shot"}, {valz: null, id: "rifle"}, {valz: null, id: "casin"}, {valz: null, id: "oncasin"}, {valz: null, id: "sports"}, {valz: null, id: "homogen"}, {valz: null, id: "homoad"}, {valz: null, id: "transgen"}, {valz: null, id: "transad"}, {valz: null, id: "tobus"}, {valz: null, id: "tobsel"}, {valz: null, id: "alcus"}, {valz: null, id: "alcsel"}, {valz: null, id: "canus"}, {valz: null, id: "cansel"}, {valz: null, id: "psyus"}, {valz: null, id: "psysel"}, {valz: null, id: "stius"}, {valz: null, id: "stisel"}, {valz: null, id: "opius"}, {valz: null, id: "opisel"}, {valz: null, id: "euth"}, {valz: null, id: "obsc"}, {valz: null, id: "warc"}, {valz: null, id: "corf"}, {valz: null, id: "blasph"}, {valz: null, id: "treas"}, {valz: null, id: "embe"}, {valz: null, id: "misce"}, {valz: null, id: "disse"}, {valz: null, id: "mifu"}, {valz: null, id: "imman"}, {valz: null, id: "immst"}, {valz: null, id: "immwo"}, {valz: null, id: "immas"}, {valz: null, id: "immref"}, {valz: null, id: "inher"}, {valz: null, id: "reserv"}, {valz: null, id: "pover"}, {valz: null, id: "unemp"}, {valz: null, id: "pens"}, {valz: null, id: "mininc"}, {valz: null, id: "basinc"}, {valz: null, id: "wast"}, {valz: null, id: "pubpa"}, {valz: null, id: "conser"}, {valz: null, id: "solar"}, {valz: null, id: "nucl"}, {valz: null, id: "rnd"}, {valz: null, id: "votr"}, {valz: null, id: "entreq"}, {valz: null, id: "envreg"}, {valz: null, id: "womrig"}, {valz: null, id: "centfun"}, {valz: null, id: "abort"}, {valz: null, id: "fabort"}];
  var kaymon = [{sov: 0, auto: 0, govg: 13.4, govc: 0, syse: 0, sysl: 0, sysj: 0, rel: 2.1, for: 0, cons: 1.4, righ: 0.8, minw: 0.8, minw2: 1.3, pensreg: 0.7, centow: 1.3, murd: 0, rape: 0, steal: 0, child: 0, defa: 0, incit: 0, stprost: 0, broth: 0, esco: 0, hand: 0, shot: 0, rifle: 0, casin: 0, oncasin: 0, sports: 0, homogen: 0, homoad: 0, transgen: 0, transad: 0, tobus: 0, tobsel: 0, alcus: 0, alcsel: 0, canus: 0, cansel: 0, psyus: 0, psysel: 0, stius: 0, stisel: 0, opius: 0, opisel: 0, euth: 0, obsc: 0, warc: 0, corf: 0, blasph: 0, treas: 0, embe: 0, misce: 0, disse: 0, mifu: null, imman: 1, immst: null, immwo: null, immas: null, immref: null, inher: 0, reserv: 0, pover: 0, unemp: 0, pens: 0, mininc: 0, basinc: 0, wast: 0, pubpa: 0, conser: 0, solar: 0, nucl: 0, rnd: 0, votr: 0.6, entreq: 0.4, envreg: 0.25, womrig: -1, centfun: 0.7, abort: -3.9, fabort: 1.2}, {sov: 0, auto: 0, govg: 13.4, govc: 1.2, syse: 1.6, sysl: 1.3, sysj: 1.3, rel: 0, for: 0.5, cons: 0, righ: 0, minw: 0.5, minw2: 0, pensreg: 0.5, centow: 1, murd: 0.1, rape: 0.1, steal: 0.4, child: 0.1, defa: 0.2, incit: 0.5, stprost: 0.1, broth: 0.1, esco: 0.1, hand: 0.1, shot: 0.1, rifle: 0.1, casin: 0.1, oncasin: 0.1, sports: 0.1, homogen: 0.4, homoad: 0.8, transgen: 0.4, transad: 0.3, tobus: 0.05, tobsel: 0.05, alcus: 0.05, alcsel: 0.05, canus: 0.05, cansel: 0.05, psyus: 0.05, psysel: 0.05, stius: 0.05, stisel: 0.05, opius: 0.05, opisel: 0.05, euth: 0.2, obsc: 0.2, warc: 0.2, corf: 0.2, blasph: 0.2, treas: 0.2, embe: 0.2, misce: 0.6, disse: 3.7, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: 0.5, pover: 0, unemp: 0, pens: 0, mininc: 0, basinc: 0, wast: 0, pubpa: 0, conser: 0, solar: 0, nucl: 0, rnd: 0, votr: 1, entreq: 0.4, envreg: 0.25, womrig: -2.2, centfun: 0.7, abort: -0.7, fabort: 1.2}, {sov: 0, auto: 0, govg: null, govc: 3.4, syse: 2.1, sysl: 2.1, sysj: 1.7, rel: 2.1, for: 1.9, cons: null, righ: 0, minw: 0, minw2: null, pensreg: 0, centow: 0, murd: 0.4, rape: 0.4, steal: 0.6, child: 0.4, defa: 0.4, incit: 0.8, stprost: 0.3, broth: 0.3, esco: 0.3, hand: 0.2, shot: 0.2, rifle: 0.2, casin: 0.2, oncasin: 0.2, sports: 0.2, homogen: 0.7, homoad: null, transgen: 0.7, transad: 0.8, tobus: 0.1, tobsel: 0.1, alcus: 0.1, alcsel: 0.1, canus: 0.1, cansel: 0.1, psyus: 0.1, psysel: 0.1, stius: 0.1, stisel: 0.1, opius: 0.1, opisel: 0.1, euth: 0.4, obsc: 0.4, warc: 0.4, corf: 0.4, blasph: 0.4, treas: 0.4, embe: 0.4, misce: 0.9, disse: 4.5, mifu: null, imman: -3.5, immst: 1, immwo: 1, immas: 1, immref: 1, inher: null, reserv: 1, pover: 0, unemp: 0, pens: 0, mininc: 0, basinc: 0, wast: 0, pubpa: 0, conser: 0, solar: 0, nucl: 0, rnd: 0, votr: 1.3, entreq: 0.8, envreg: 0.25, womrig: -1, centfun: 1.15, abort: -0.7, fabort: 1.2}, {sov: 0, auto: 0, govg: null, govc: 4.7, syse: 2.8, sysl: 3.2, sysj: 2.2, rel: null, for: 3.7, cons: null, righ: 1.9, minw: null, minw2: null, pensreg: null, centow: null, murd: 0.5, rape: 0.5, steal: 0.8, child: 0.5, defa: 0.6, incit: 1, stprost: 0.5, broth: 0.5, esco: 0.5, hand: 0.3, shot: 0.3, rifle: 0.3, casin: 0.3, oncasin: 0.3, sports: 0.3, homogen: 1.05, homoad: null, transgen: 1.05, transad: null, tobus: 0.15, tobsel: 0.15, alcus: 0.15, alcsel: 0.15, canus: 0.15, cansel: 0.15, psyus: 0.15, psysel: 0.15, stius: 0.15, stisel: 0.15, opius: 0.15, opisel: 0.15, euth: 0.8, obsc: 0.7, warc: 0.6, corf: 0.6, blasph: 0.6, treas: 0.6, embe: 0.6, misce: 1.1, disse: 5.2, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 1.3, entreq: 0.8, envreg: 0.25, womrig: -1.8, centfun: null, abort: -0.7, fabort: null}, {sov: null, auto: 0, govg: null, govc: 3.4, syse: null, sysl: null, sysj: null, rel: null, for: 4.9, cons: null, righ: 2.7, minw: null, minw2: null, pensreg: null, centow: null, murd: 0.8, rape: 0.8, steal: 1.2, child: 0.8, defa: 1, incit: 1.4, stprost: 0.6, broth: 0.6, esco: 0.6, hand: 0.5, shot: 0.5, rifle: 0.5, casin: 0.4, oncasin: 0.4, sports: 0.4, homogen: 1.35, homoad: null, transgen: 1.35, transad: null, tobus: 0.2, tobsel: 0.2, alcus: 0.2, alcsel: 0.2, canus: 0.2, cansel: 0.2, psyus: 0.2, psysel: 0.2, stius: 0.2, stisel: 0.2, opius: 0.2, opisel: 0.2, euth: 1.4, obsc: 1.2, warc: 1, corf: 1, blasph: 1.1, treas: 1, embe: 1, misce: 1.5, disse: 7, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: 0.65, womrig: 0.6, centfun: null, abort: -0.7, fabort: null}, {sov: null, auto: null, govg: null, govc: 3.4, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0.9, broth: 0.9, esco: 0.9, hand: 0.7, shot: 0.7, rifle: 0.7, casin: 0.7, oncasin: 0.7, sports: 0.7, homogen: 1.5, homoad: null, transgen: 1.5, transad: null, tobus: 0.35, tobsel: 0.35, alcus: 0.35, alcsel: 0.35, canus: 0.35, cansel: 0.35, psyus: 0.35, psysel: 0.35, stius: 0.35, stisel: 0.35, opius: 0.35, opisel: 0.35, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: 0.6, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 1, shot: 1, rifle: 1, casin: null, oncasin: null, sports: null, homogen: 1.8, homoad: null, transgen: 1.8, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 1.5, shot: 1.5, rifle: 1.5, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  var taariq = [{sov: 0, auto: 24.3, govg: 0, govc: 3, syse: 0, sysl: 0, sysj: 0, rel: 0, for: 0, cons: 1, righ: 0, minw: 0, minw2: 0, pensreg: 0, centow: 0, murd: 0, rape: 0, steal: 0, child: 0, defa: 0, incit: 0, stprost: 0, broth: 0, esco: 0, hand: 0, shot: 0, rifle: 0, casin: 0, oncasin: 0, sports: 0, homogen: 0, homoad: 0, transgen: 0, transad: 0, tobus: 0, tobsel: 0, alcus: 0, alcsel: 0, canus: 0, cansel: 0, psyus: 0, psysel: 0, stius: 0, stisel: 0, opius: 0, opisel: 0, euth: 0, obsc: 0, warc: 0, corf: 0, blasph: 0, treas: 0, embe: 0, misce: 0, disse: 0, mifu: null, imman: 1, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: -2, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 0.4, entreq: 0.4, envreg: -0.6, womrig: -1, centfun: -0.7, abort: -4, fabort: -1.2}, {sov: 6.5, auto: 24.3, govg: 3.2, govc: 0, syse: 1, sysl: 0.7, sysj: 0.7, rel: 1.1, for: 1, cons: 0, righ: 1, minw: 2.6, minw2: 2, pensreg: 0.7, centow: 0.8, murd: 0, rape: 0, steal: 0, child: 0, defa: 0, incit: 0, stprost: 0.1, broth: 0.1, esco: 0.1, hand: 0, shot: 0, rifle: 0, casin: 0.2, oncasin: 0.2, sports: 0.2, homogen: 0.4, homoad: 1.2, transgen: 0.4, transad: 0.6, tobus: 0.1, tobsel: 0.1, alcus: 0.1, alcsel: 0.1, canus: 0.1, cansel: 0.1, psyus: 0.1, psysel: 0.1, stius: 0.1, stisel: 0.1, opius: 0.1, opisel: 0.1, euth: 0.5, obsc: 1, warc: 0, corf: 0, blasph: 1, treas: 0.3, embe: 0, misce: 1.1, disse: 0, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 0.6, entreq: 0.4, envreg: -0.6, womrig: -0.8, centfun: -0.7, abort: -0.5, fabort: 0}, {sov: 6.5, auto: 24.3, govg: null, govc: 0, syse: 1.9, sysl: 1.1, sysj: 1.1, rel: 3, for: 1.6, cons: null, righ: 1.2, minw: 3.6, minw2: null, pensreg: 2.2, centow: 2.2, murd: 0, rape: 0, steal: -0.8, child: 0, defa: 0, incit: 0, stprost: 0.3, broth: 0.3, esco: 0.3, hand: 0, shot: 0, rifle: 0, casin: 0.3, oncasin: 0.3, sports: 0.3, homogen: 1, homoad: null, transgen: 1, transad: 1.2, tobus: 0.2, tobsel: 0.2, alcus: 0.2, alcsel: 0.2, canus: 0.2, cansel: 0.2, psyus: 0.2, psysel: 0.2, stius: 0.2, stisel: 0.2, opius: 0.2, opisel: 0.2, euth: 0.7, obsc: 1.2, warc: 0, corf: 0, blasph: 1.4, treas: 0.5, embe: 0, misce: 1.4, disse: 0, mifu: null, imman: -5, immst: 0.45, immwo: 0.8, immas: 0.9, immref: 1, inher: null, reserv: -2, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 1, entreq: 1.1, envreg: -0.6, womrig: -1, centfun: -1.1, abort: -0.8, fabort: 1.2}, {sov: 6.5, auto: 24.3, govg: null, govc: 4.5, syse: 3.8, sysl: 2.1, sysj: 2.1, rel: null, for: 3, cons: null, righ: 1.8, minw: null, minw2: null, pensreg: null, centow: null, murd: 0, rape: 0, steal: -1, child: 0, defa: 0, incit: 0, stprost: 0.45, broth: 0.45, esco: 0.45, hand: 0, shot: 0, rifle: 0, casin: 0.5, oncasin: 0.5, sports: 0.5, homogen: 1.3, homoad: null, transgen: 1.3, transad: null, tobus: 0.25, tobsel: 0.25, alcus: 0.25, alcsel: 0.25, canus: 0.25, cansel: 0.25, psyus: 0.25, psysel: 0.25, stius: 0.25, stisel: 0.25, opius: 0.25, opisel: 0.25, euth: 0.9, obsc: 1.5, warc: 0, corf: 0, blasph: 1.6, treas: 0.7, embe: 0, misce: 1.6, disse: 0, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 1.5, entreq: 1.1, envreg: -0.6, womrig: -1, centfun: null, abort: -0.8, fabort: null}, {sov: null, auto: 24.3, govg: null, govc: 4.5, syse: null, sysl: null, sysj: null, rel: null, for: 4.6, cons: null, righ: 2, minw: null, minw2: null, pensreg: null, centow: null, murd: 0, rape: 0, steal: -1.2, child: 0, defa: 0, incit: 0, stprost: 0.6, broth: 0.6, esco: 0.6, hand: 0, shot: 0, rifle: 0, casin: 0.6, oncasin: 0.6, sports: 0.6, homogen: 1.5, homoad: null, transgen: 1.5, transad: null, tobus: 0.3, tobsel: 0.3, alcus: 0.3, alcsel: 0.3, canus: 0.3, cansel: 0.3, psyus: 0.3, psysel: 0.3, stius: 0.3, stisel: 0.3, opius: 0.3, opisel: 0.3, euth: 1, obsc: 1.7, warc: 0, corf: 0, blasph: 1.9, treas: 0.8, embe: 0, misce: 2, disse: 0, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: -1.2, womrig: -0.5, centfun: null, abort: -1, fabort: null}, {sov: null, auto: null, govg: null, govc: 4.5, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0.9, broth: 0.9, esco: 0.9, hand: 0, shot: 0, rifle: 0, casin: 0.8, oncasin: 0.8, sports: 0.8, homogen: 1.9, homoad: null, transgen: 1.9, transad: null, tobus: 0.35, tobsel: 0.35, alcus: 0.35, alcsel: 0.35, canus: 0.35, cansel: 0.35, psyus: 0.35, psysel: 0.35, stius: 0.35, stisel: 0.35, opius: 0.35, opisel: 0.35, euth: 1.5, obsc: 1.9, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: -0.5, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 0, shot: 0, rifle: 0, casin: null, oncasin: null, sports: null, homogen: 2.2, homoad: null, transgen: 2.2, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 0, shot: 0, rifle: 0, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  var lakley = [{sov: 10.5, auto: 6, govg: 0, govc: 0, syse: 0, sysl: 0, sysj: 0, rel: 1.8, for: 0, cons: 1.5, righ: 0, minw: 0, minw2: 0, pensreg: 0, centow: 0, murd: 0, rape: 0, steal: 0, child: 0, defa: 0, incit: 0, stprost: 0, broth: 0, esco: 0, hand: 0, shot: 0, rifle: 0, casin: 0, oncasin: 0, sports: 0, homogen: 0, homoad: 0, transgen: 0, transad: 0, tobus: 0, tobsel: 0, alcus: 0, alcsel: 0, canus: 0, cansel: 0, psyus: 0, psysel: 0, stius: 0, stisel: 0, opius: 0, opisel: 0, euth: 0, obsc: 0, warc: 0, corf: 0, blasph: 0, treas: 0, embe: 0, misce: 0, disse: 0, mifu: 0, imman: 0.8, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 0.8, entreq: 0.2, envreg: 0, womrig: -0.9, centfun: 0, abort: -3.2, fabort: 1.6}, {sov: 10.5, auto: 3.5, govg: 3.3, govc: 2.5, syse: 2, sysl: 1, sysj: 1, rel: 0, for: 0, cons: 0, righ: 0, minw: 0, minw2: 0, pensreg: 0, centow: 0, murd: 0.1, rape: 0.1, steal: 0.4, child: 0.1, defa: 0.3, incit: 0.5, stprost: 0.1, broth: 0.1, esco: 0.1, hand: 0.1, shot: 0.1, rifle: 0.1, casin: 0.1, oncasin: 0.1, sports: 0.1, homogen: 0.3, homoad: 0.4, transgen: 0.3, transad: 0.25, tobus: 0.05, tobsel: 0.05, alcus: 0.05, alcsel: 0.05, canus: 0.05, cansel: 0.05, psyus: 0.05, psysel: 0.05, stius: 0.05, stisel: 0.05, opius: 0.05, opisel: 0.05, euth: 0.1, obsc: 0.3, warc: 0.1, corf: 0.3, blasph: 0.3, treas: 0.3, embe: 0.3, misce: 0.3, disse: 6.5, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 1.6, entreq: 0.2, envreg: 0, womrig: -0.9, centfun: 0, abort: -0.8, fabort: 1.6}, {sov: 10.5, auto: 2, govg: null, govc: 3, syse: 2.5, sysl: 2, sysj: 1.9, rel: 1.8, for: 0.5, cons: null, righ: 0, minw: 0, minw2: null, pensreg: 0, centow: 0, murd: 0.2, rape: 0.2, steal: 0.6, child: 0.2, defa: 0.5, incit: 0.8, stprost: 0.2, broth: 0.2, esco: 0.2, hand: 0.2, shot: 0.2, rifle: 0.2, casin: 0.15, oncasin: 0.15, sports: 0.15, homogen: 0.45, homoad: null, transgen: 0.45, transad: 0.4, tobus: 0.1, tobsel: 0.1, alcus: 0.1, alcsel: 0.1, canus: 0.1, cansel: 0.1, psyus: 0.1, psysel: 0.1, stius: 0.1, stisel: 0.1, opius: 0.1, opisel: 0.1, euth: 0.25, obsc: 0.5, warc: 0.2, corf: 0.5, blasph: 0.5, treas: 0.5, embe: 0.5, misce: 0.5, disse: 7, mifu: 2.5, imman: -2.5, immst: 1, immwo: 1, immas: 1, immref: 1, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 2.2, entreq: 0.4, envreg: 0, womrig: -0.9, centfun: 0, abort: -0.6, fabort: 1.9}, {sov: 10.5, auto: 1, govg: null, govc: 4.9, syse: 3.5, sysl: 4, sysj: 2.8, rel: null, for: 1, cons: null, righ: 1, minw: null, minw2: null, pensreg: null, centow: null, murd: 0.35, rape: 0.35, steal: 0.9, child: 0.35, defa: 0.8, incit: 1.1, stprost: 0.35, broth: 0.35, esco: 0.35, hand: 0.4, shot: 0.4, rifle: 0.4, casin: 0.35, oncasin: 0.35, sports: 0.35, homogen: 1, homoad: null, transgen: 1, transad: null, tobus: 0.15, tobsel: 0.15, alcus: 0.15, alcsel: 0.15, canus: 0.15, cansel: 0.15, psyus: 0.15, psysel: 0.15, stius: 0.15, stisel: 0.15, opius: 0.15, opisel: 0.15, euth: 0.4, obsc: 0.8, warc: 0.35, corf: 0.8, blasph: 0.8, treas: 0.7, embe: 0.8, misce: 0.8, disse: 8.5, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 1.8, entreq: 0.4, envreg: 0, womrig: -2.1, centfun: null, abort: -0.4, fabort: null}, {sov: null, auto: 0, govg: null, govc: 2.8, syse: null, sysl: null, sysj: null, rel: null, for: 2.4, cons: null, righ: 2.9, minw: null, minw2: null, pensreg: null, centow: null, murd: 0.5, rape: 0.5, steal: 1.2, child: 0.6, defa: 1.1, incit: 1.5, stprost: 0.5, broth: 0.5, esco: 0.5, hand: 0.6, shot: 0.6, rifle: 0.6, casin: 0.45, oncasin: 0.45, sports: 0.45, homogen: 1.2, homoad: null, transgen: 1.2, transad: null, tobus: 0.25, tobsel: 0.25, alcus: 0.25, alcsel: 0.25, canus: 0.25, cansel: 0.25, psyus: 0.25, psysel: 0.25, stius: 0.25, stisel: 0.25, opius: 0.25, opisel: 0.25, euth: 0.6, obsc: 1.2, warc: 0.6, corf: 1, blasph: 1.2, treas: 1, embe: 1, misce: 1.2, disse: 10, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: 0, womrig: 0, centfun: null, abort: -0.4, fabort: null}, {sov: null, auto: null, govg: null, govc: 3, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 0.9, shot: 0.9, rifle: 0.9, casin: 0.6, oncasin: 0.6, sports: 0.6, homogen: 1.4, homoad: null, transgen: 1.4, transad: null, tobus: 0.35, tobsel: 0.35, alcus: 0.35, alcsel: 0.35, canus: 0.35, cansel: 0.35, psyus: 0.35, psysel: 0.35, stius: 0.35, stisel: 0.35, opius: 0.35, opisel: 0.35, euth: 1, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: 0, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 1.2, shot: 1.2, rifle: 1.2, casin: null, oncasin: null, sports: null, homogen: 1.7, homoad: null, transgen: 1.7, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 1.7, shot: 1.7, rifle: 1.7, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  var damontray = [{sov: null, auto: null, govg: 29.7, govc: 0, syse: 0, sysl: null, sysj: null, rel: -8, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0, broth: 0, esco: 0, hand: null, shot: null, rifle: null, casin: 0, oncasin: 0, sports: 0, homogen: 0, homoad: 0, transgen: 0, transad: 0, tobus: 0, tobsel: 0, alcus: 0, alcsel: 0, canus: 0, cansel: 0, psyus: 0, psysel: 0, stius: 0, stisel: 0, opius: 0, opisel: 0, euth: 0, obsc: 0, warc: null, corf: null, blasph: 0, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 0, envreg: null, womrig: -2, centfun: null, abort: -6.7, fabort: -1}, {sov: null, auto: null, govg: 29.7, govc: 0, syse: 0, sysl: null, sysj: null, rel: 0, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0.5, broth: 0.5, esco: 0.5, hand: null, shot: null, rifle: null, casin: 0.3, oncasin: 0.3, sports: 0.3, homogen: 1, homoad: 3, transgen: 0.8, transad: 1.7, tobus: 0.15, tobsel: 0.15, alcus: 0.15, alcsel: 0.15, canus: 0.15, cansel: 0.15, psyus: 0.15, psysel: 0.15, stius: 0.15, stisel: 0.15, opius: 0.15, opisel: 0.15, euth: 0.8, obsc: 2.2, warc: null, corf: null, blasph: 3.5, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 0, envreg: null, womrig: -2, centfun: null, abort: -0.9, fabort: -1}, {sov: null, auto: null, govg: null, govc: -2, syse: 0, sysl: null, sysj: null, rel: 7.6, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 2, broth: 2, esco: 2, hand: null, shot: null, rifle: null, casin: 1.8, oncasin: 1.8, sports: 1.8, homogen: 2.5, homoad: null, transgen: 2.5, transad: 3, tobus: 0.4, tobsel: 0.4, alcus: 0.4, alcsel: 0.4, canus: 0.4, cansel: 0.4, psyus: 0.4, psysel: 0.4, stius: 0.4, stisel: 0.4, opius: 0.4, opisel: 0.4, euth: 1.2, obsc: 3.5, warc: null, corf: null, blasph: 4.4, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: -0.5, nucl: -0.5, rnd: -2, votr: null, entreq: 0, envreg: null, womrig: -2, centfun: null, abort: -1.2, fabort: -1}, {sov: null, auto: null, govg: null, govc: 0, syse: 3, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 2.6, broth: 2.6, esco: 2.6, hand: null, shot: null, rifle: null, casin: 2.2, oncasin: 2.2, sports: 2.2, homogen: 3, homoad: null, transgen: 3, transad: null, tobus: 0.6, tobsel: 0.6, alcus: 0.6, alcsel: 0.6, canus: 0.6, cansel: 0.6, psyus: 0.6, psysel: 0.6, stius: 0.6, stisel: 0.6, opius: 0.6, opisel: 0.6, euth: 1.8, obsc: 3.5, warc: null, corf: null, blasph: 4.4, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 4.5, envreg: null, womrig: -1, centfun: null, abort: -1.2, fabort: null}, {sov: null, auto: null, govg: null, govc: 0, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 2.6, broth: 2.6, esco: 2.6, hand: null, shot: null, rifle: null, casin: 2.2, oncasin: 2.2, sports: 2.2, homogen: 4, homoad: null, transgen: 4, transad: null, tobus: 0.6, tobsel: 0.6, alcus: 0.6, alcsel: 0.6, canus: 0.6, cansel: 0.6, psyus: 0.6, psysel: 0.6, stius: 0.6, stisel: 0.6, opius: 0.6, opisel: 0.6, euth: 3.7, obsc: 3.5, warc: null, corf: null, blasph: 4.4, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: -1.4, fabort: null}, {sov: null, auto: null, govg: null, govc: 8, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 2.6, broth: 2.6, esco: 2.6, hand: null, shot: null, rifle: null, casin: 2.2, oncasin: 2.2, sports: 2.2, homogen: 4, homoad: null, transgen: 4, transad: null, tobus: 0.6, tobsel: 0.6, alcus: 0.6, alcsel: 0.6, canus: 0.6, cansel: 0.6, psyus: 0.6, psysel: 0.6, stius: 0.6, stisel: 0.6, opius: 0.6, opisel: 0.6, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: 4, homoad: null, transgen: 4, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  var neya = [{sov: 0, auto: 2, govg: 30.7, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 0, cons: 1.8, righ: 0, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: 0, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: 0, embe: null, misce: 0, disse: null, mifu: null, imman: 4, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 0, entreq: 1.5, envreg: null, womrig: null, centfun: null, abort: null, fabort: 0}, {sov: 11, auto: 4.6, govg: 30.7, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 3.4, cons: 0, righ: 2.5, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: -3.5, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: 0.8, embe: null, misce: 6, disse: null, mifu: null, imman: -12.5, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 0, entreq: 1, envreg: null, womrig: null, centfun: null, abort: null, fabort: 0}, {sov: 11, auto: 3.5, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 3, cons: null, righ: 4.5, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: -5.7, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: 1.8, embe: null, misce: 8, disse: null, mifu: null, imman: -25, immst: 0.45, immwo: 0.7, immas: 0.9, immref: 1, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 0, entreq: 5.5, envreg: null, womrig: null, centfun: null, abort: null, fabort: 6.9}, {sov: 11, auto: 2, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 2, cons: null, righ: 8, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: -5.7, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: 2, embe: null, misce: 8, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 6.2, entreq: 1.9, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: 0, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 3.4, cons: null, righ: 10.8, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: -5.7, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: 2.6, embe: null, misce: 8, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  var virginnia = [{sov: null, auto: null, govg: 12, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 2.2, minw: 14, minw2: 7, pensreg: 17, centow: 12, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0, broth: 0, esco: 0, hand: 0, shot: 0, rifle: 0, casin: 0, oncasin: 0, sports: 0, homogen: null, homoad: null, transgen: null, transad: null, tobus: 0, tobsel: 0, alcus: 0, alcsel: 0, canus: 0, cansel: 0, psyus: 0, psysel: 0, stius: 0, stisel: 0, opius: 0, opisel: 0, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: 2, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: 1.1, womrig: 0, centfun: 1.5, abort: null, fabort: null}, {sov: null, auto: null, govg: 12, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 0, minw: 9, minw2: 0, pensreg: 7, centow: 8, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0.2, broth: 0.2, esco: 0.2, hand: 0.2, shot: 0.2, rifle: 0.2, casin: 0.2, oncasin: 0.2, sports: 0.2, homogen: null, homoad: null, transgen: null, transad: null, tobus: 0.1, tobsel: 0.1, alcus: 0.1, alcsel: 0.1, canus: 0.1, cansel: 0.1, psyus: 0.1, psysel: 0.1, stius: 0.1, stisel: 0.1, opius: 0.1, opisel: 0.1, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: 1.1, womrig: -7, centfun: 2, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 0, minw: 0, minw2: null, pensreg: 0, centow: 0, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0.4, broth: 0.4, esco: 0.4, hand: 0.4, shot: 0.4, rifle: 0.4, casin: 0.4, oncasin: 0.4, sports: 0.4, homogen: null, homoad: null, transgen: null, transad: null, tobus: 0.25, tobsel: 0.25, alcus: 0.25, alcsel: 0.25, canus: 0.25, cansel: 0.25, psyus: 0.25, psysel: 0.25, stius: 0.25, stisel: 0.25, opius: 0.25, opisel: 0.25, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: -5, immst: 0, immwo: 1, immas: 0, immref: 0, inher: null, reserv: 3.5, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: 0.8, nucl: 0.8, rnd: null, votr: null, entreq: null, envreg: 1.1, womrig: 0, centfun: 3, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 0, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0.4, broth: 0.4, esco: 0.4, hand: 0.4, shot: 0.4, rifle: 0.4, casin: 0.4, oncasin: 0.4, sports: 0.4, homogen: null, homoad: null, transgen: null, transad: null, tobus: 0.25, tobsel: 0.25, alcus: 0.25, alcsel: 0.25, canus: 0.25, cansel: 0.25, psyus: 0.25, psysel: 0.25, stius: 0.25, stisel: 0.25, opius: 0.25, opisel: 0.25, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: 1, womrig: 0, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 0, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0.4, broth: 0.4, esco: 0.4, hand: 0.4, shot: 0.4, rifle: 0.4, casin: 0.4, oncasin: 0.4, sports: 0.4, homogen: null, homoad: null, transgen: null, transad: null, tobus: 0.25, tobsel: 0.25, alcus: 0.25, alcsel: 0.25, canus: 0.25, cansel: 0.25, psyus: 0.25, psysel: 0.25, stius: 0.25, stisel: 0.25, opius: 0.25, opisel: 0.25, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: 3.7, womrig: 1.5, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 0.4, broth: 0.4, esco: 0.4, hand: 0.4, shot: 0.4, rifle: 0.4, casin: 0.4, oncasin: 0.4, sports: 0.4, homogen: null, homoad: null, transgen: null, transad: null, tobus: 0.25, tobsel: 0.25, alcus: 0.25, alcsel: 0.25, canus: 0.25, cansel: 0.25, psyus: 0.25, psysel: 0.25, stius: 0.25, stisel: 0.25, opius: 0.25, opisel: 0.25, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: 3, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  var jamhal = [{sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 0, cons: null, righ: 0, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: 0, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 1, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 0, cons: null, righ: 0, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: 1, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 1, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 0, cons: null, righ: 0, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: 1, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 1, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 0, cons: null, righ: 1, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: 1, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: 1, entreq: 1, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: 1, cons: null, righ: 1, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: 1, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  var arling = [{sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: 0, rape: 0, steal: 0, child: 0, defa: 0, incit: 0, stprost: 0, broth: 0, esco: 0, hand: 0, shot: 0, rifle: 0, casin: 0, oncasin: 0, sports: 0, homogen: 0, homoad: null, transgen: 0, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: 0, warc: 0, corf: 0, blasph: 0, treas: 0, embe: 0, misce: 0, disse: 0, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: 0, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: 1, rape: 1, steal: 1, child: 1, defa: 1, incit: 1, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: 0.2, homoad: null, transgen: 0.2, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: 1, warc: 0.3, corf: 1, blasph: 1, treas: 0.5, embe: 1, misce: 1, disse: 1.5, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 1, broth: 1, esco: 1, hand: 0.5, shot: 0.5, rifle: 0, casin: 1, oncasin: 1, sports: 1, homogen: 0, homoad: null, transgen: 0, transad: null, tobus: 1, tobsel: 1, alcus: 1, alcsel: 1, canus: 1, cansel: 1, psyus: 1, psysel: 1, stius: 1, stisel: 1, opius: 1, opisel: 1, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 0.2, shot: 0.2, rifle: 0.2, casin: null, oncasin: null, sports: null, homogen: 1, homoad: null, transgen: 1, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 1, shot: 1, rifle: 1, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: null, shot: null, rifle: null, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  var jeyda = [{sov: 50, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 2.2, minw: null, minw2: null, pensreg: null, centow: 5, murd: 0, rape: 0, steal: 0, child: 0, defa: 0, incit: 0, stprost: 0, broth: 0, esco: 0, hand: 0, shot: 0, rifle: 0, casin: 0, oncasin: 0, sports: 0, homogen: 0, homoad: 0, transgen: 0, transad: 0, tobus: 0, tobsel: 0, alcus: 0, alcsel: 0, canus: 0, cansel: 0, psyus: 0, psysel: 0, stius: 0, stisel: 0, opius: 0, opisel: 0, euth: null, obsc: 0, warc: 0, corf: 0, blasph: 0, treas: 0, embe: 0, misce: 0, disse: 0, mifu: null, imman: 0, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 0.1, envreg: null, womrig: null, centfun: null, abort: 0, fabort: 0.5}, {sov: 35, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 0, minw: null, minw2: null, pensreg: null, centow: 0, murd: 0.5, rape: 0.5, steal: 0.5, child: 0.5, defa: 0.5, incit: 0.5, stprost: 0.2, broth: 0.2, esco: 0.2, hand: 0.2, shot: 0.2, rifle: 0.2, casin: 0.2, oncasin: 0.2, sports: 0.2, homogen: 0, homoad: 0, transgen: 0, transad: 0, tobus: 0, tobsel: 0.2, alcus: 0, alcsel: 0.2, canus: 0, cansel: 0.2, psyus: 0, psysel: 0.2, stius: 0, stisel: 0.2, opius: 0, opisel: 0.2, euth: null, obsc: 0.5, warc: 0.5, corf: 0.5, blasph: 0.5, treas: 0.5, embe: 0.5, misce: 0.5, disse: 0.5, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 0.2, envreg: null, womrig: null, centfun: null, abort: 0.2, fabort: 0.5}, {sov: 30, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 0, minw: null, minw2: null, pensreg: null, centow: 0, murd: 0.5, rape: 0.5, steal: 0.5, child: 0.5, defa: 0.5, incit: 0.5, stprost: null, broth: null, esco: null, hand: 0.5, shot: 0.5, rifle: 0.5, casin: 0.5, oncasin: 0.5, sports: 0.5, homogen: 0, homoad: null, transgen: 0, transad: null, tobus: 0.5, tobsel: 0.5, alcus: 0.5, alcsel: 0.5, canus: 0.5, cansel: 0.5, psyus: 0.5, psysel: 0.5, stius: 0.5, stisel: 0.5, opius: 0.5, opisel: 0.5, euth: null, obsc: 1, warc: 0.3, corf: 1, blasph: 1, treas: 0.5, embe: 1, misce: 1, disse: 1.5, mifu: null, imman: -25, immst: 0.7, immwo: 1, immas: 1, immref: 1, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 0.3, envreg: null, womrig: null, centfun: null, abort: 0.2, fabort: 0.5}, {sov: 25, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 0.5, minw: null, minw2: null, pensreg: null, centow: null, murd: 1, rape: 1, steal: 1, child: 1, defa: 1, incit: 1, stprost: 0.5, broth: 0.5, esco: 0.5, hand: 0.5, shot: 0.5, rifle: 0.5, casin: 1, oncasin: 1, sports: 1, homogen: 0.5, homoad: null, transgen: 0.5, transad: null, tobus: 1, tobsel: 1, alcus: 1, alcsel: 1, canus: 1, cansel: 1, psyus: 1, psysel: 1, stius: 1, stisel: 1, opius: 1, opisel: 1, euth: null, obsc: 1, warc: 0.3, corf: 1, blasph: 1, treas: 0.5, embe: 1, misce: 1, disse: 1.5, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: 0.4, envreg: null, womrig: null, centfun: null, abort: 0.2, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: 1.5, minw: null, minw2: null, pensreg: null, centow: null, murd: 1, rape: 1, steal: 1, child: 1, defa: 1, incit: 1, stprost: 1, broth: 1, esco: 1, hand: 0.5, shot: 0.5, rifle: 0.5, casin: 1, oncasin: 1, sports: 1, homogen: 1, homoad: null, transgen: 1, transad: null, tobus: 1, tobsel: 1, alcus: 1, alcsel: 1, canus: 1, cansel: 1, psyus: 1, psysel: 1, stius: 1, stisel: 1, opius: 1, opisel: 1, euth: null, obsc: 1, warc: 0.3, corf: 1, blasph: 1, treas: 0.5, embe: 1, misce: 1, disse: 1.5, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: 0.2, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: 1, broth: 1, esco: 1, hand: 1, shot: 1, rifle: 1, casin: 1, oncasin: 1, sports: 1, homogen: 1, homoad: null, transgen: 1, transad: null, tobus: 1, tobsel: 1, alcus: 1, alcsel: 1, canus: 1, cansel: 1, psyus: 1, psysel: 1, stius: 1, stisel: 1, opius: 1, opisel: 1, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 1, shot: 1, rifle: 1, casin: null, oncasin: null, sports: null, homogen: 1, homoad: null, transgen: 1, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}, {sov: null, auto: null, govg: null, govc: null, syse: null, sysl: null, sysj: null, rel: null, for: null, cons: null, righ: null, minw: null, minw2: null, pensreg: null, centow: null, murd: null, rape: null, steal: null, child: null, defa: null, incit: null, stprost: null, broth: null, esco: null, hand: 1, shot: 1, rifle: 1, casin: null, oncasin: null, sports: null, homogen: null, homoad: null, transgen: null, transad: null, tobus: null, tobsel: null, alcus: null, alcsel: null, canus: null, cansel: null, psyus: null, psysel: null, stius: null, stisel: null, opius: null, opisel: null, euth: null, obsc: null, warc: null, corf: null, blasph: null, treas: null, embe: null, misce: null, disse: null, mifu: null, imman: null, immst: null, immwo: null, immas: null, immref: null, inher: null, reserv: null, pover: null, unemp: null, pens: null, mininc: null, basinc: null, wast: null, pubpa: null, conser: null, solar: null, nucl: null, rnd: null, votr: null, entreq: null, envreg: null, womrig: null, centfun: null, abort: null, fabort: null}];
  $(".loader").fadeOut("fast");
  $(document).ready(function () {
    $(document).bind("contextmenu", function (evelinn) {
      if (!$(evelinn.target).is("input")) {
        return false;
      }
    });
  });
  $("#submit_btn").click(function () {
    var rauri = true;
    $("#contact_form input[required=true], #contact_form textarea[required=true]").each(function () {
      $(this).css("border-color", "");
      if (!$.trim($(this).val())) {
        $(this).css("border-color", "red");
        rauri = false;
      }
      ;
      var nail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if ($(this).attr("type") == "email" && !nail.test($.trim($(this).val()))) {
        $(this).css("border-color", "red");
        rauri = false;
      }
    });
    if (rauri) {
      post_data = {subject: $("select[name=subject]").val(), msg: $("textarea[name=message]").val()};
      $.post("feeder.php", post_data, function (baheerah) {
        if (baheerah.type == "error") {
          output = '<div class="error">' + baheerah.text + "</div>";
        } else {
          output = '<div class="success">' + baheerah.text + "</div>";
          $("#contact_form  input[required=true], #contact_form textarea[required=true]").val("");
          $("#contact_form #contact_body").slideUp();
        }
        ;
        $("#contact_form #contact_results").hide().html(output).slideDown();
      }, "json");
    }
  });
  $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function () {
    $(this).css("border-color", "");
    $("#result").slideUp();
  });
  $(".opener").click(function () {
    if ($(this).next().is(":visible")) {
      $(".submenu1").fadeOut("fast", "linear");
      $(".submenu2").fadeOut("fast", "linear");
      $(".submenu3").fadeOut("fast", "linear");
      $(".submenu4").fadeOut("fast", "linear");
      $(".submenu5").fadeOut("fast", "linear");
    } else {
      $(".submenu1").fadeOut("fast", "linear");
      $(".submenu2").fadeOut("fast", "linear");
      $(".submenu3").fadeOut("fast", "linear");
      $(".submenu4").fadeOut("fast", "linear");
      $(".submenu5").fadeOut("fast", "linear");
      $(this).next().fadeToggle("fast", "linear");
    }
  });
  $(".btcz").click(function () {
    if ($(this).next().next().is(":visible")) {
      $(".donop").fadeOut("fast", "linear");
      $(".mendon").removeClass("finmenact");
      $(this).removeClasss("cbtcz");
    } else {
      $(".donop").fadeOut("fast", "linear");
      $(".mendon").removeClass("finmenact");
      $(this).next().next().fadeIn("fast", "linear");
      $(this).toggleClass("finmenact");
      $(this).toggleClass("cbtcz");
    }
  });
  $(".ethz").click(function () {
    if ($(this).next().next().is(":visible")) {
      $(".donop").fadeOut("fast", "linear");
      $(".mendon").removeClass("finmenact");
      $(this).removeClass("cethz");
    } else {
      $(".donop").fadeOut("fast", "linear");
      $(".mendon").removeClass("finmenact");
      $(this).next().next().fadeIn("fast", "linear");
      $(this).toggleClass("finmenact");
      $(this).toggleClass("cethz");
    }
  });
  $(".btcco").click(function () {
    $(".btcad").select();
    document.execCommand("copy");
  });
  $(".ethco").click(function () {
    $(".ethad").select();
    document.execCommand("copy");
  });
  $("body").mousedown(function (maggielean) {
    if ($(maggielean.target).closest(".finmenop").length === 0) {
      $(".finmenop").fadeOut("fast", "linear");
      $(".finmen").removeClass("finmenact");
    }
  });
  $("body").mousedown(function (reon) {
    if ($(reon.target).closest(".donop").length === 0) {
      $(".donop").fadeOut("fast", "linear");
      $(".mendon").removeClass("finmenact");
    }
  });
  $(".pubz1").click(function () {
    $(this).removeClass("titof");
    $(this).next(".priz1").addClass("titof");
    $(this).next().next().find(".priz2").addClass("abser");
    $(this).next().next().find(".pubz2").removeClass("abser");
    $(this).next().next().find(".priz2").fadeOut("fast", "swing");
    $(this).next().next().find(".pubz2").fadeIn("fast", "swing");
  });
  $(".priz1").click(function () {
    $(this).removeClass("titof");
    $(this).prev(".pubz1").addClass("titof");
    $(this).next().find(".pubz2").addClass("abser");
    $(this).next().find(".priz2").removeClass("abser");
    $(this).next().find(".pubz2").fadeOut("fast", "swing");
    $(this).next().find(".priz2").fadeIn("fast", "swing");
  });
  $(".allspub1").click(function () {
    $(".pubz1").removeClass("titof");
    $(".pubz1").next(".priz1").addClass("titof");
    $(".priz2").addClass("abser");
    $(".pubz2").removeClass("abser");
    $(".priz2").fadeOut("fast", "swing");
    $(".pubz2").fadeIn("fast", "swing");
  });
  $(".allspri1").click(function () {
    $(".priz1").removeClass("titof");
    $(".priz1").prev(".pubz1").addClass("titof");
    $(".pubz2").addClass("abser");
    $(".priz2").removeClass("abser");
    $(".pubz2").fadeOut("fast", "swing");
    $(".priz2").fadeIn("fast", "swing");
  });
  $(function () {
    $("[data-popup-open]").on("click", function (miayah) {
      var vrinda = jQuery(this).attr("data-popup-open");
      $('[data-popup="' + vrinda + '"]').fadeIn(350);
      miayah.preventDefault();
    });
    $("[data-popup-close]").on("click", function (lorrel) {
      var soloman = jQuery(this).attr("data-popup-close");
      $('[data-popup="' + soloman + '"]').fadeOut(350);
      lorrel.preventDefault();
    });
  });
  $("body").mousedown(function (aracelis) {
    if ($(aracelis.target).closest(".submenu1,.submenu2,.submenu3,.submenu4,.submenu5,.setter,#sett,.select2-results__options,.opener,.slidz,.ui-slider,.boxxer").length === 0) {
      $(".submenu1").fadeOut("fast", "linear");
      $(".submenu2").fadeOut("fast", "linear");
      $(".submenu3").fadeOut("fast", "linear");
      $(".submenu4").fadeOut("fast", "linear");
      $(".submenu5").fadeOut("fast", "linear");
    }
  });
  $("body").mousedown(function (dakayden) {
    if ($(dakayden.target).closest(".btdon").length === 0) {
      $(".btdon").fadeOut("fast", "linear");
    }
  });
  $("body").mousedown(function (gracielle) {
    if ($(gracielle.target).closest(".etdon").length === 0) {
      $(".etdon").fadeOut("fast", "linear");
    }
  });
  $("body").mousedown(function (ovianna) {
    if ($(ovianna.target).closest(".ltdon").length === 0) {
      $(".ltdon").fadeOut("fast", "linear");
    }
  });
  $(".locker").click(function () {
    $(this).find($(".fa")).toggleClass("fa-lock fa-unlock-alt");
  });
  $(".openerz").click(function () {
    $(this).next().fadeToggle("fast", "linear");
    $(this).find($(".fa")).toggleClass("fa-chevron-down fa-chevron-up");
  });
  Math.easeIn = function (anglina, nakaiyah, kashema, anezka) {
    anglina /= kashema;
    return (kashema - 1) * Math.pow(anglina, anezka) + nakaiyah;
  };
  $(".tbot").qtip({style: {classes: "qtip-tip", tip: false}, position: {}});
  $(".tlef").qtip({style: {classes: "qtip-tip", tip: false}, position: {my: "top right", at: "left"}});
  $(".ttop").qtip({style: {classes: "qtip-tip", tip: false}, position: {my: "bottom left", at: "right center"}});
  $(".chooser").select2({minimumResultsForSearch: Infinity, closeOnSelect: false});
  $("select").on("change", function (valda) {
    $(".select2-selection__rendered").removeAttr("title");
    $(".select2-selection__choice").removeAttr("title");
  });
  $('b[role="presentation"]').hide();
  $(".select2-search, .select2-focusser").remove();
  $("select").on("select2:unselect", function (maks) {
    if (!maks.params.originalEvent) {
      return;
    }
    ;
    maks.params.originalEvent.stopPropagation();
  });
  $("#eduprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (domonik, miquelle) {
    if (miquelle.value > 0) {
      var caydan = "+";
    } else {
      caydan = "";
    }
    ;
    $(".eduprc").html("Prices: " + caydan + miquelle.value + "%");
  }});
  $("#eduwag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (blaydon, darshaun) {
    if (darshaun.value > 0) {
      var asyria = "+";
    } else {
      asyria = "";
    }
    ;
    $(".eduwag").html("Wages: " + asyria + darshaun.value + "%");
  }});
  $("#eduwagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (aide, raydene) {
    $(".eduwagr").html("Wage Ratio: " + (raydene.value + 100));
  }});
  $("#edupex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (luby, jovani) {
    $(".edupex").html("Exports: " + jovani.value + "%");
  }});
  $("#medprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (dortha, colbey) {
    if (colbey.value > 0) {
      var ayaana = "+";
    } else {
      ayaana = "";
    }
    ;
    $(".medprc").html("Prices: " + ayaana + colbey.value + "%");
  }});
  $("#medwag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (tootie, mimi) {
    if (mimi.value > 0) {
      var daxter = "+";
    } else {
      daxter = "";
    }
    ;
    $(".medwag").html("Wages: " + daxter + mimi.value + "%");
  }});
  $("#medwagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (ken, kenady) {
    $(".medwagr").html("Wage Ratio: " + (kenady.value + 100));
  }});
  $("#medpex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (ethangabriel, aleezay) {
    $(".medpex").html("Exports: " + aleezay.value + "%");
  }});
  $("#bankprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (dezlyn, charay) {
    if (charay.value > 0) {
      var kandie = "+";
    } else {
      kandie = "";
    }
    ;
    $(".bankprc").html("Prices: " + kandie + charay.value + "%");
  }});
  $("#bankwag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (amberrae, labreeska) {
    if (labreeska.value > 0) {
      var lynnen = "+";
    } else {
      lynnen = "";
    }
    ;
    $(".bankwag").html("Wages: " + lynnen + labreeska.value + "%");
  }});
  $("#bankwagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (leelan, azeria) {
    $(".bankwagr").html("Wage Ratio: " + (azeria.value + 100));
  }});
  $("#bankpex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (taqi, yared) {
    $(".bankpex").html("Exports: " + yared.value + "%");
  }});
  $("#heaprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (emireth, parthiv) {
    if (parthiv.value > 0) {
      var shemaine = "+";
    } else {
      shemaine = "";
    }
    ;
    $(".heaprc").html("Prices: " + shemaine + parthiv.value + "%");
  }});
  $("#heawag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (maddee, jahkir) {
    if (jahkir.value > 0) {
      var kyheim = "+";
    } else {
      kyheim = "";
    }
    ;
    $(".heawag").html("Wages: " + kyheim + jahkir.value + "%");
  }});
  $("#heawagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (solly, kerigan) {
    $(".heawagr").html("Wage Ratio: " + (kerigan.value + 100));
  }});
  $("#heapex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (letita, vincent) {
    $(".heapex").html("Exports: " + vincent.value + "%");
  }});
  $("#retprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (hammed, mckaylia) {
    if (mckaylia.value > 0) {
      var racin = "+";
    } else {
      racin = "";
    }
    ;
    $(".retprc").html("Prices: " + racin + mckaylia.value + "%");
  }});
  $("#retwag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (starlisa, confesor) {
    if (confesor.value > 0) {
      var alexanra = "+";
    } else {
      alexanra = "";
    }
    ;
    $(".retwag").html("Wages: " + alexanra + confesor.value + "%");
  }});
  $("#retwagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (zanyia, napolean) {
    $(".retwagr").html("Wage Ratio: " + (napolean.value + 100));
  }});
  $("#retpex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (montoyia, arthena) {
    $(".retpex").html("Exports: " + arthena.value + "%");
  }});
  $("#manuprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (kenzlyn, zalayia) {
    if (zalayia.value > 0) {
      var talor = "+";
    } else {
      talor = "";
    }
    ;
    $(".manuprc").html("Prices: " + talor + zalayia.value + "%");
  }});
  $("#manuwag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (nikel, afreen) {
    if (afreen.value > 0) {
      var dareus = "+";
    } else {
      dareus = "";
    }
    ;
    $(".manuwag").html("Wages: " + dareus + afreen.value + "%");
  }});
  $("#manuwagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (emilda, stephanny) {
    $(".manuwagr").html("Wage Ratio: " + (stephanny.value + 100));
  }});
  $("#manupex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (givanna, jubran) {
    $(".manupex").html("Exports: " + jubran.value + "%");
  }});
  $("#infrprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (brittinie, dezi) {
    if (dezi.value > 0) {
      var wayland = "+";
    } else {
      wayland = "";
    }
    ;
    $(".infrprc").html("Prices: " + wayland + dezi.value + "%");
  }});
  $("#infrwag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (louva, skylla) {
    if (skylla.value > 0) {
      var donabelle = "+";
    } else {
      donabelle = "";
    }
    ;
    $(".infrwag").html("Wages: " + donabelle + skylla.value + "%");
  }});
  $("#infrwagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (willett, jaunte) {
    $(".infrwagr").html("Wage Ratio: " + (jaunte.value + 100));
  }});
  $("#infrpex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (abilio, muzik) {
    $(".infrpex").html("Exports: " + muzik.value + "%");
  }});
  $("#agrprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (ainesh, kassadee) {
    if (kassadee.value > 0) {
      var misaki = "+";
    } else {
      misaki = "";
    }
    ;
    $(".agrprc").html("Prices: " + misaki + kassadee.value + "%");
  }});
  $("#agrwag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (rodneka, rashone) {
    if (rashone.value > 0) {
      var talha = "+";
    } else {
      talha = "";
    }
    ;
    $(".agrwag").html("Wages: " + talha + rashone.value + "%");
  }});
  $("#agrwagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (myja, cherryle) {
    $(".agrwagr").html("Wage Ratio: " + (cherryle.value + 100));
  }});
  $("#agrpex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (arati, tynisa) {
    $(".agrpex").html("Exports: " + tynisa.value + "%");
  }});
  $("#natprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (tessi, killis) {
    if (killis.value > 0) {
      var anetha = "+";
    } else {
      anetha = "";
    }
    ;
    $(".natprc").html("Prices: " + anetha + killis.value + "%");
  }});
  $("#natwag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (jennife, felissia) {
    if (felissia.value > 0) {
      var kyzen = "+";
    } else {
      kyzen = "";
    }
    ;
    $(".natwag").html("Wages: " + kyzen + felissia.value + "%");
  }});
  $("#natwagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (tishawn, somi) {
    $(".natwagr").html("Wage Ratio: " + (somi.value + 100));
  }});
  $("#natpex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (melanney, oleda) {
    $(".natpex").html("Exports: " + oleda.value + "%");
  }});
  $("#reacom1").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (aariketh, mercede) {
    if (mercede.value > 0) {
      var sumayya = "+";
    } else {
      sumayya = "";
    }
    ;
    $(".reacom1").html("Selling Prices: " + sumayya + mercede.value + "%");
  }});
  $("#reacom2").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (damyen, alene) {
    if (alene.value > 0) {
      var terel = "+";
    } else {
      terel = "";
    }
    ;
    $(".reacom2").html("Renting Prices: " + terel + alene.value + "%");
  }});
  $("#allsprc").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (jennice, jodette) {
    if (jodette.value > 0) {
      var deletta = "+";
    } else {
      deletta = "";
    }
    ;
    $("#heaprc").slider("value", jodette.value);
    $("#eduprc").slider("value", jodette.value);
    $("#agrprc").slider("value", jodette.value);
    $("#manuprc").slider("value", jodette.value);
    $("#bankprc").slider("value", jodette.value);
    $("#retprc").slider("value", jodette.value);
    $("#medprc").slider("value", jodette.value);
    $("#infrprc").slider("value", jodette.value);
    $("#reaprc").slider("value", jodette.value);
    $("#natprc").slider("value", jodette.value);
    $(".heaprc").html("Prices: " + deletta + jodette.value + "%");
    $(".eduprc").html("Prices: " + deletta + jodette.value + "%");
    $(".agrprc").html("Prices: " + deletta + jodette.value + "%");
    $(".manuprc").html("Prices: " + deletta + jodette.value + "%");
    $(".bankprc").html("Prices: " + deletta + jodette.value + "%");
    $(".retprc").html("Prices: " + deletta + jodette.value + "%");
    $(".medprc").html("Prices: " + deletta + jodette.value + "%");
    $(".infrprc").html("Prices: " + deletta + jodette.value + "%");
    $(".reaprc").html("Prices: " + deletta + jodette.value + "%");
    $(".natprc").html("Prices: " + deletta + jodette.value + "%");
    $(".allsprc").html("Prices: " + deletta + jodette.value + "%");
  }});
  $("#allswag").slider({value: 0, min: -100, max: 100, step: 0.1, slide: function (eina, jaydenmichael) {
    if (jaydenmichael.value > 0) {
      var cleaston = "+";
    } else {
      cleaston = "";
    }
    ;
    $("#heawag").slider("value", jaydenmichael.value);
    $("#eduwag").slider("value", jaydenmichael.value);
    $("#agrwag").slider("value", jaydenmichael.value);
    $("#manuwag").slider("value", jaydenmichael.value);
    $("#bankwag").slider("value", jaydenmichael.value);
    $("#retwag").slider("value", jaydenmichael.value);
    $("#medwag").slider("value", jaydenmichael.value);
    $("#infrwag").slider("value", jaydenmichael.value);
    $("#reawag").slider("value", jaydenmichael.value);
    $("#natwag").slider("value", jaydenmichael.value);
    $(".heawag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".eduwag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".agrwag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".manuwag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".bankwag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".retwag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".medwag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".infrwag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".reawag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".natwag").html("Wages: " + cleaston + jaydenmichael.value + "%");
    $(".allswag").html("Wages: " + cleaston + jaydenmichael.value + "%");
  }});
  $("#allswagr").slider({value: 0, min: -99, max: 400, step: 1, slide: function (sheeneeka, chirag) {
    $("#heawagr").slider("value", chirag.value);
    $("#eduwagr").slider("value", chirag.value);
    $("#agrwagr").slider("value", chirag.value);
    $("#manuwagr").slider("value", chirag.value);
    $("#bankwagr").slider("value", chirag.value);
    $("#retwagr").slider("value", chirag.value);
    $("#medwagr").slider("value", chirag.value);
    $("#infrwagr").slider("value", chirag.value);
    $("#reawagr").slider("value", chirag.value);
    $("#natwagr").slider("value", chirag.value);
    $(".heawagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".eduwagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".agrwagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".manuwagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".bankwagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".retwagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".medwagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".infrwagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".reawagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".natwagr").html("Wage Ratio: " + (chirag.value + 100));
    $(".allswagr").html("Wage Ratio: " + (chirag.value + 100));
  }});
  $("#allspex").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (aylia, bruchy) {
    $("#heapex").slider("value", bruchy.value);
    $("#edupex").slider("value", bruchy.value);
    $("#agrpex").slider("value", bruchy.value);
    $("#manupex").slider("value", bruchy.value);
    $("#bankpex").slider("value", bruchy.value);
    $("#retpex").slider("value", bruchy.value);
    $("#medpex").slider("value", bruchy.value);
    $("#infrpex").slider("value", bruchy.value);
    $("#reapex").slider("value", bruchy.value);
    $("#natpex").slider("value", bruchy.value);
    $(".heapex").html("Exports: " + bruchy.value + "%");
    $(".edupex").html("Exports: " + bruchy.value + "%");
    $(".agrpex").html("Exports: " + bruchy.value + "%");
    $(".manupex").html("Exports: " + bruchy.value + "%");
    $(".bankpex").html("Exports: " + bruchy.value + "%");
    $(".retpex").html("Exports: " + bruchy.value + "%");
    $(".medpex").html("Exports: " + bruchy.value + "%");
    $(".infrpex").html("Exports: " + bruchy.value + "%");
    $(".reapex").html("Exports: " + bruchy.value + "%");
    $(".natpex").html("Exports: " + bruchy.value + "%");
    $(".allspex").html("Exports: " + bruchy.value + "%");
  }});
  $("#heaow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (tymber, geff) {
    $(".heaow").html("Public Ownership: " + geff.value + "%");
  }});
  $("#heafun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (nema, charlynne) {
    $(".heafun").html("Subsidies: " + charlynne.value + "%");
  }});
  $("#heainc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (hidemi, sheera) {
    $(".heainc").html("Personal Tax: " + sheera.values[0] + "% - " + sheera.values[1] + "%");
  }});
  $("#heacor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (saphira, merley) {
    $(".heacor").html("Corporate Tax: " + merley.values[0] + "% - " + merley.values[1] + "%");
  }});
  $("#heacons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (jourden, cynitha) {
    $(".heacons").html("Consumption Tax: " + cynitha.value + "%");
  }});
  $("#heaimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (mars, crystopher) {
    $(".heaimp").html("Import Tariffs: " + crystopher.value + "%");
  }});
  $("#heaexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (legacie, khaleo) {
    $(".heaexp").html("Export Tariffs: " + khaleo.value + "%");
  }});
  $("#eduow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (shannan, angeliah) {
    $(".eduow").html("Public Ownership: " + angeliah.value + "%");
  }});
  $("#edufun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (cordalro, eluteria) {
    $(".edufun").html("Subsidies: " + eluteria.value + "%");
  }});
  $("#eduinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (annjelica, kasidy) {
    $(".eduinc").html("Personal Tax: " + kasidy.values[0] + "% - " + kasidy.values[1] + "%");
  }});
  $("#educor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (eliz, shauntea) {
    $(".educor").html("Corporate Tax: " + shauntea.values[0] + "% - " + shauntea.values[1] + "%");
  }});
  $("#educons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (loura, cannan) {
    $(".educons").html("Consumption Tax: " + cannan.value + "%");
  }});
  $("#eduimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (rozanne, timiya) {
    $(".eduimp").html("Import Tariffs: " + timiya.value + "%");
  }});
  $("#eduexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (zong, pax) {
    $(".eduexp").html("Export Tariffs: " + pax.value + "%");
  }});
  $("#agrow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (juelene, brasia) {
    $(".agrow").html("Public Ownership: " + brasia.value + "%");
  }});
  $("#agrfun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (brunson, maricris) {
    $(".agrfun").html("Subsidies: " + maricris.value + "%");
  }});
  $("#agrinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (adriel, marylisa) {
    $(".agrinc").html("Personal Tax: " + marylisa.values[0] + "% - " + marylisa.values[1] + "%");
  }});
  $("#agrcor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (jabbaar, hiroyuki) {
    $(".agrcor").html("Corporate Tax: " + hiroyuki.values[0] + "% - " + hiroyuki.values[1] + "%");
  }});
  $("#agrcons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (pryscilla, fleshia) {
    $(".agrcons").html("Consumption Tax: " + fleshia.value + "%");
  }});
  $("#agrimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (kuntakinte, artesha) {
    $(".agrimp").html("Import Tariffs: " + artesha.value + "%");
  }});
  $("#agrexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (roxey, haedyn) {
    $(".agrexp").html("Export Tariffs: " + haedyn.value + "%");
  }});
  $("#manuow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (sefora, sid) {
    $(".manuow").html("Public Ownership: " + sid.value + "%");
  }});
  $("#manufun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (ometa, carri) {
    $(".manufun").html("Subsidies: " + carri.value + "%");
  }});
  $("#manuinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (hermelinda, teaerra) {
    $(".manuinc").html("Personal Tax: " + teaerra.values[0] + "% - " + teaerra.values[1] + "%");
  }});
  $("#manucor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (matayah, shamkia) {
    $(".manucor").html("Corporate Tax: " + shamkia.values[0] + "% - " + shamkia.values[1] + "%");
  }});
  $("#manucons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (valo, shayal) {
    $(".manucons").html("Consumption Tax: " + shayal.value + "%");
  }});
  $("#manuimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (brynna, marcusjames) {
    $(".manuimp").html("Import Tariffs: " + marcusjames.value + "%");
  }});
  $("#manuexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (bella, eliot) {
    $(".manuexp").html("Export Tariffs: " + eliot.value + "%");
  }});
  $("#bankow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (dejamarie, lorielle) {
    $(".bankow").html("Public Ownership: " + lorielle.value + "%");
  }});
  $("#bankfun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (ezekeial, gillard) {
    $(".bankfun").html("Subsidies: " + gillard.value + "%");
  }});
  $("#bankinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (callandra, sway) {
    $(".bankinc").html("Personal Tax: " + sway.values[0] + "% - " + sway.values[1] + "%");
  }});
  $("#bankcor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (caidenn, rinka) {
    $(".bankcor").html("Corporate Tax: " + rinka.values[0] + "% - " + rinka.values[1] + "%");
  }});
  $("#bankcons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (orlena, xuri) {
    $(".bankcons").html("Capital Gains Tax: " + xuri.value + "%");
  }});
  $("#bankimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (jaidon, zakyrie) {
    $(".bankimp").html("Import Tariffs: " + zakyrie.value + "%");
  }});
  $("#bankexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (evilo, josejavier) {
    $(".bankexp").html("Export Tariffs: " + josejavier.value + "%");
  }});
  $("#retow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (kiomy, auri) {
    $(".retow").html("Public Ownership: " + auri.value + "%");
  }});
  $("#retfun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (kyliah, biannca) {
    $(".retfun").html("Subsidies: " + biannca.value + "%");
  }});
  $("#retinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (lilbert, sherryle) {
    $(".retinc").html("Personal Tax: " + sherryle.values[0] + "% - " + sherryle.values[1] + "%");
  }});
  $("#retcor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (khory, tenell) {
    $(".retcor").html("Corporate Tax: " + tenell.values[0] + "% - " + tenell.values[1] + "%");
  }});
  $("#retcons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (susi, edmar) {
    $(".retcons").html("Consumption Tax: " + edmar.value + "%");
  }});
  $("#retimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (enga, doha) {
    $(".retimp").html("Import Tariffs: " + doha.value + "%");
  }});
  $("#retexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (tyme, billiejo) {
    $(".retexp").html("Export Tariffs: " + billiejo.value + "%");
  }});
  $("#medow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (valdon, prissila) {
    $(".medow").html("Public Ownership: " + prissila.value + "%");
  }});
  $("#medfun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (dayah, ninja) {
    $(".medfun").html("Subsidies: " + ninja.value + "%");
  }});
  $("#medinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (ellah, elexus) {
    $(".medinc").html("Personal Tax: " + elexus.values[0] + "% - " + elexus.values[1] + "%");
  }});
  $("#medcor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (lineth, abbiegail) {
    $(".medcor").html("Corporate Tax: " + abbiegail.values[0] + "% - " + abbiegail.values[1] + "%");
  }});
  $("#medcons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (karmia, yaakov) {
    $(".medcons").html("Consumption Tax: " + yaakov.value + "%");
  }});
  $("#medimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (abel, kemaurion) {
    $(".medimp").html("Import Tariffs: " + kemaurion.value + "%");
  }});
  $("#medexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (riken, harvel) {
    $(".medexp").html("Export Tariffs: " + harvel.value + "%");
  }});
  $("#infrow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (joshep, frontis) {
    $(".infrow").html("Public Ownership: " + frontis.value + "%");
  }});
  $("#infrfun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (shawan, johnross) {
    $(".infrfun").html("Subsidies: " + johnross.value + "%");
  }});
  $("#infrinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (maiti, zaine) {
    $(".infrinc").html("Personal Tax: " + zaine.values[0] + "% - " + zaine.values[1] + "%");
  }});
  $("#infrcor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (cyanna, beret) {
    $(".infrcor").html("Corporate Tax: " + beret.values[0] + "% - " + beret.values[1] + "%");
  }});
  $("#infrcons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (hiwot, eustolia) {
    $(".infrcons").html("Consumption Tax: " + eustolia.value + "%");
  }});
  $("#infrimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (dalajah, bartlett) {
    $(".infrimp").html("Import Tariffs: " + bartlett.value + "%");
  }});
  $("#infrexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (tucker, kalisse) {
    $(".infrexp").html("Export Tariffs: " + kalisse.value + "%");
  }});
  $("#natow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (nielah, dayra) {
    $(".natow").html("Public Ownership: " + dayra.value + "%");
  }});
  $("#natfun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (beltran, ellexis) {
    $(".natfun").html("Subsidies: " + ellexis.value + "%");
  }});
  $("#natinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (luvella, aldin) {
    $(".natinc").html("Personal Tax: " + aldin.values[0] + "% - " + aldin.values[1] + "%");
  }});
  $("#natcor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (kaiyel, gillianna) {
    $(".natcor").html("Corporate Tax: " + gillianna.values[0] + "% - " + gillianna.values[1] + "%");
  }});
  $("#natcons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (kealeigh, jenia) {
    $(".natcons").html("Consumption Tax: " + jenia.value + "%");
  }});
  $("#natimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (aimsley, kamaria) {
    $(".natimp").html("Import Tariffs: " + kamaria.value + "%");
  }});
  $("#natexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (prairie, anysia) {
    $(".natexp").html("Export Tariffs: " + anysia.value + "%");
  }});
  $("#reaow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (adlia, saphronia) {
    $(".reaow").html("Public Ownership: " + saphronia.value + "%");
  }});
  $("#reareg0").slider({value: 20, min: 0, max: 100, step: 0.1, slide: function (egan, ralana) {
    $(".reareg0").html("Subsidies: " + ralana.value + "%");
  }});
  $("#reareg1").slider({value: 6, min: 0, max: 100, step: 0.1, slide: function (taiyon, kila) {
    $(".reareg1").html("Land Tax: " + kila.value + "%");
  }});
  $("#reareg2").slider({value: 6, min: 0, max: 100, step: 0.1, slide: function (kaceon, lendia) {
    $(".reareg2").html("Property Tax: " + lendia.value + "%");
  }});
  $("#reareg3").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (carista, myana) {
    $(".reareg3").html("Rent Tax: " + myana.value + "%");
  }});
  $("#reareg4").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (fardeen, challise) {
    $(".reareg4").html("Sales Tax: " + challise.value + "%");
  }});
  $("#allsow").slider({value: 30, min: 0, max: 100, step: 0.1, slide: function (talayja, russella) {
    $("#heaow").slider("value", russella.value);
    $("#eduow").slider("value", russella.value);
    $("#agrow").slider("value", russella.value);
    $("#manuow").slider("value", russella.value);
    $("#bankow").slider("value", russella.value);
    $("#retow").slider("value", russella.value);
    $("#medow").slider("value", russella.value);
    $("#infrow").slider("value", russella.value);
    $("#reaow").slider("value", russella.value);
    $("#natow").slider("value", russella.value);
    $(".heaow").html("Public Ownership: " + russella.value + "%");
    $(".eduow").html("Public Ownership: " + russella.value + "%");
    $(".agrow").html("Public Ownership: " + russella.value + "%");
    $(".manuow").html("Public Ownership: " + russella.value + "%");
    $(".bankow").html("Public Ownership: " + russella.value + "%");
    $(".retow").html("Public Ownership: " + russella.value + "%");
    $(".medow").html("Public Ownership: " + russella.value + "%");
    $(".infrow").html("Public Ownership: " + russella.value + "%");
    $(".reaow").html("Public Ownership: " + russella.value + "%");
    $(".natow").html("Public Ownership: " + russella.value + "%");
    $(".allsow").html("Public Ownership: " + russella.value + "%");
  }});
  $("#allsfun").slider({value: 15, min: 0, max: 100, step: 0.1, slide: function (yuvonka, flourish) {
    $("#heafun").slider("value", flourish.value);
    $("#edufun").slider("value", flourish.value);
    $("#agrfun").slider("value", flourish.value);
    $("#manufun").slider("value", flourish.value);
    $("#bankfun").slider("value", flourish.value);
    $("#retfun").slider("value", flourish.value);
    $("#medfun").slider("value", flourish.value);
    $("#infrfun").slider("value", flourish.value);
    $("#reareg0").slider("value", flourish.value);
    $("#natfun").slider("value", flourish.value);
    $(".heafun").html("Subsidies: " + flourish.value + "%");
    $(".edufun").html("Subsidies: " + flourish.value + "%");
    $(".agrfun").html("Subsidies: " + flourish.value + "%");
    $(".manufun").html("Subsidies: " + flourish.value + "%");
    $(".bankfun").html("Subsidies: " + flourish.value + "%");
    $(".retfun").html("Subsidies: " + flourish.value + "%");
    $(".medfun").html("Subsidies: " + flourish.value + "%");
    $(".infrfun").html("Subsidies: " + flourish.value + "%");
    $(".reareg0").html("Subsidies: " + flourish.value + "%");
    $(".natfun").html("Subsidies: " + flourish.value + "%");
    $(".allsfun").html("Subsidies: " + flourish.value + "%");
  }});
  $("#allsinc").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (kylani, tayte) {
    $("#heainc").slider("values", 0, tayte.values[0]);
    $("#eduinc").slider("values", 0, tayte.values[0]);
    $("#agrinc").slider("values", 0, tayte.values[0]);
    $("#manuinc").slider("values", 0, tayte.values[0]);
    $("#bankinc").slider("values", 0, tayte.values[0]);
    $("#retinc").slider("values", 0, tayte.values[0]);
    $("#medinc").slider("values", 0, tayte.values[0]);
    $("#infrinc").slider("values", 0, tayte.values[0]);
    $("#reainc").slider("values", 0, tayte.values[0]);
    $("#natinc").slider("values", 0, tayte.values[0]);
    $("#heainc").slider("values", 1, tayte.values[1]);
    $("#eduinc").slider("values", 1, tayte.values[1]);
    $("#agrinc").slider("values", 1, tayte.values[1]);
    $("#manuinc").slider("values", 1, tayte.values[1]);
    $("#bankinc").slider("values", 1, tayte.values[1]);
    $("#retinc").slider("values", 1, tayte.values[1]);
    $("#medinc").slider("values", 1, tayte.values[1]);
    $("#infrinc").slider("values", 1, tayte.values[1]);
    $("#reainc").slider("values", 1, tayte.values[1]);
    $("#natinc").slider("values", 1, tayte.values[1]);
    $(".heainc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".eduinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".agrinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".manuinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".bankinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".retinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".medinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".infrinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".reainc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".natinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
    $(".allsinc").html("Personal Tax: " + tayte.values[0] + "% - " + tayte.values[1] + "%");
  }});
  $("#allscor").slider({range: true, values: [0, 50], min: 0, max: 100, step: 0.1, slide: function (dalyssa, oliviya) {
    $("#heacor").slider("values", 0, oliviya.values[0]);
    $("#educor").slider("values", 0, oliviya.values[0]);
    $("#agrcor").slider("values", 0, oliviya.values[0]);
    $("#manucor").slider("values", 0, oliviya.values[0]);
    $("#bankcor").slider("values", 0, oliviya.values[0]);
    $("#retcor").slider("values", 0, oliviya.values[0]);
    $("#medcor").slider("values", 0, oliviya.values[0]);
    $("#infrcor").slider("values", 0, oliviya.values[0]);
    $("#reacor").slider("values", 0, oliviya.values[0]);
    $("#natcor").slider("values", 0, oliviya.values[0]);
    $("#heacor").slider("values", 1, oliviya.values[1]);
    $("#educor").slider("values", 1, oliviya.values[1]);
    $("#agrcor").slider("values", 1, oliviya.values[1]);
    $("#manucor").slider("values", 1, oliviya.values[1]);
    $("#bankcor").slider("values", 1, oliviya.values[1]);
    $("#retcor").slider("values", 1, oliviya.values[1]);
    $("#medcor").slider("values", 1, oliviya.values[1]);
    $("#infrcor").slider("values", 1, oliviya.values[1]);
    $("#reacor").slider("values", 1, oliviya.values[1]);
    $("#natcor").slider("values", 1, oliviya.values[1]);
    $(".heacor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".educor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".agrcor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".manucor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".bankcor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".retcor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".medcor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".infrcor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".reacor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".natcor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
    $(".allscor").html("Corporate Tax: " + oliviya.values[0] + "% - " + oliviya.values[1] + "%");
  }});
  $("#allscons").slider({value: 12, min: 0, max: 100, step: 0.1, slide: function (andreika, kynsley) {
    $("#heacons").slider("value", kynsley.value);
    $("#educons").slider("value", kynsley.value);
    $("#agrcons").slider("value", kynsley.value);
    $("#manucons").slider("value", kynsley.value);
    $("#bankcons").slider("value", kynsley.value);
    $("#retcons").slider("value", kynsley.value);
    $("#medcons").slider("value", kynsley.value);
    $("#infrcons").slider("value", kynsley.value);
    $("#reacons").slider("value", kynsley.value);
    $("#natcons").slider("value", kynsley.value);
    $(".heacons").html("Consumption Tax: " + kynsley.value + "%");
    $(".educons").html("Consumption Tax: " + kynsley.value + "%");
    $(".agrcons").html("Consumption Tax: " + kynsley.value + "%");
    $(".manucons").html("Consumption Tax: " + kynsley.value + "%");
    $(".bankcons").html("Capital Gains Tax: " + kynsley.value + "%");
    $(".retcons").html("Consumption Tax: " + kynsley.value + "%");
    $(".medcons").html("Consumption Tax: " + kynsley.value + "%");
    $(".infrcons").html("Consumption Tax: " + kynsley.value + "%");
    $(".reacons").html("Consumption Tax: " + kynsley.value + "%");
    $(".natcons").html("Consumption Tax: " + kynsley.value + "%");
    $(".allscons").html("Consumption Tax: " + kynsley.value + "%");
  }});
  $("#allsimp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (kasside, pamilla) {
    $("#heaimp").slider("value", pamilla.value);
    $("#eduimp").slider("value", pamilla.value);
    $("#agrimp").slider("value", pamilla.value);
    $("#manuimp").slider("value", pamilla.value);
    $("#bankimp").slider("value", pamilla.value);
    $("#retimp").slider("value", pamilla.value);
    $("#medimp").slider("value", pamilla.value);
    $("#infrimp").slider("value", pamilla.value);
    $("#reaimp").slider("value", pamilla.value);
    $("#natimp").slider("value", pamilla.value);
    $(".heaimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".eduimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".agrimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".manuimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".bankimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".retimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".medimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".infrimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".reaimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".natimp").html("Import Tariffs: " + pamilla.value + "%");
    $(".allsimp").html("Import Tariffs: " + pamilla.value + "%");
  }});
  $("#allsexp").slider({value: 25, min: 0, max: 150, step: 0.1, slide: function (surafel, khiem) {
    $("#heaexp").slider("value", khiem.value);
    $("#eduexp").slider("value", khiem.value);
    $("#agrexp").slider("value", khiem.value);
    $("#manuexp").slider("value", khiem.value);
    $("#bankexp").slider("value", khiem.value);
    $("#retexp").slider("value", khiem.value);
    $("#medexp").slider("value", khiem.value);
    $("#infrexp").slider("value", khiem.value);
    $("#reaexp").slider("value", khiem.value);
    $("#natexp").slider("value", khiem.value);
    $(".heaexp").html("Export Tariffs: " + khiem.value + "%");
    $(".eduexp").html("Export Tariffs: " + khiem.value + "%");
    $(".agrexp").html("Export Tariffs: " + khiem.value + "%");
    $(".manuexp").html("Export Tariffs: " + khiem.value + "%");
    $(".bankexp").html("Export Tariffs: " + khiem.value + "%");
    $(".retexp").html("Export Tariffs: " + khiem.value + "%");
    $(".medexp").html("Export Tariffs: " + khiem.value + "%");
    $(".infrexp").html("Export Tariffs: " + khiem.value + "%");
    $(".reaexp").html("Export Tariffs: " + khiem.value + "%");
    $(".natexp").html("Export Tariffs: " + khiem.value + "%");
    $(".allsexp").html("Export Tariffs: " + khiem.value + "%");
  }});
  $("#mifu").slider({value: 10, min: 0, max: 100, step: 0.1, slide: function (nyir, wong) {
    $(".mifu").html("Funding: " + wong.value + "%");
  }});
  $("#imman").slider({value: 0.8, min: 0, max: 2.5, step: 0.1, slide: function (keahi, cressa) {
    $(".imman").html("Annual Limit: " + cressa.value + "%");
    if (cressa.value == 2.5) {
      $(".imman").html("Annual Limit: No Limit");
    }
  }});
  $("#immst").slider({value: 40, min: 0, max: 100, step: 0.1, slide: function (kiyaan, malika) {
    $(".immst").html("Students: " + malika.value + "%");
  }});
  $("#immwo").slider({value: 40, min: 0, max: 100, step: 0.1, slide: function (moeko, sheilla) {
    $(".immwo").html("Workers: " + sheilla.value + "%");
  }});
  $("#immas").slider({value: 10, min: 0, max: 100, step: 0.1, slide: function (haven, linneah) {
    $(".immas").html("Asylees: " + linneah.value + "%");
  }});
  $("#immref").slider({value: 10, min: 0, max: 100, step: 0.1, slide: function (mayrene, laylarose) {
    $(".immref").html("Refugees: " + laylarose.value + "%");
  }});
  $("#inher").slider({range: true, values: [0, 6], min: 0, max: 100, step: 0.1, slide: function (tomesia, damu) {
    $(".inher").html("Inheritance Tax: " + damu.values[0] + "% - " + damu.values[1] + "%");
  }});
  $("#reserv").slider({value: 25, min: 0, max: 100, step: 0.1, slide: function (alicyn, aldric) {
    $(".reserv").html("Cash Reserve Ratio: " + aldric.value + "%");
  }});
  $("#pover").slider({value: 50, min: 0, max: 100, step: 0.1, slide: function (galicia, eddythe) {
    $(".pover").html("Poverty Fund: " + eddythe.value + "%");
  }});
  $("#unemp").slider({value: 50, min: 0, max: 100, step: 0.1, slide: function (gianmarcos, devon) {
    $(".unemp").html("Unemployed Fund: " + devon.value + "%");
  }});
  $("#pens").slider({value: 50, min: 0, max: 100, step: 0.1, slide: function (deuntray, ousman) {
    $(".pens").html("Pension Fund: " + ousman.value + "%");
  }});
  $("#mininc").slider({value: 25, min: 0, max: 100, step: 0.1, slide: function (shaqua, anee) {
    $(".mininc").html("Minimum Income: " + anee.value + "%");
  }});
  $("#basinc").slider({value: 3, min: 0, max: 100, step: 0.1, slide: function (estralita, ostara) {
    $(".basinc").html("Basic Income: " + ostara.value + "%");
  }});
  $("#wast").slider({value: 50, min: 0, max: 100, step: 0.1, slide: function (almore, lyllyan) {
    $(".wast").html("Waste Disposal: " + lyllyan.value + "%");
  }});
  $("#pubpa").slider({value: 50, min: 0, max: 100, step: 0.1, slide: function (ginneh, juwuan) {
    $(".pubpa").html("Public Parks: " + juwuan.value + "%");
  }});
  $("#conser").slider({value: 50, min: 0, max: 100, step: 0.1, slide: function (carlicia, kibbie) {
    $(".conser").html("Conservation: " + kibbie.value + "%");
  }});
  $("#solar").slider({value: 25, min: 0, max: 100, step: 0.1, slide: function (yolotzin, shaquashia) {
    $(".solar").html("Solar Energy: " + shaquashia.value + "%");
  }});
  $("#nucl").slider({value: 25, min: 0, max: 100, step: 0.1, slide: function (shamieka, daymein) {
    $(".nucl").html("Nuclear Energy: " + daymein.value + "%");
  }});
  $("#rnd").slider({value: 8, min: 0, max: 100, step: 0.1, slide: function (aurther, yola) {
    $(".rnd").html("Science: " + yola.value + "%");
  }});
  $("#edugdp").slider({value: 4.1, min: 0.1, max: 100, step: 0.1, slide: function (shamiyah, delayney) {
    $(".edugdp").html("Education: " + delayney.value + "%");
  }});
  $("#medgdp").slider({value: 3.1, min: 0.1, max: 100, step: 0.1, slide: function (leylanie, traedyn) {
    $(".medgdp").html("Media: " + traedyn.value + "%");
  }});
  $("#bankgdp").slider({value: 9.7, min: 0.1, max: 100, step: 0.1, slide: function (anikka, zaeveon) {
    $(".bankgdp").html("Finance: " + zaeveon.value + "%");
  }});
  $("#heagdp").slider({value: 9, min: 0.1, max: 100, step: 0.1, slide: function (amariss, kortnei) {
    $(".heagdp").html("Healthcare: " + kortnei.value + "%");
  }});
  $("#retgdp").slider({value: 13.6, min: 0.1, max: 100, step: 0.1, slide: function (kia, artell) {
    $(".retgdp").html("Retail: " + artell.value + "%");
  }});
  $("#manugdp").slider({value: 27.8, min: 0.1, max: 100, step: 0.1, slide: function (tollie, norrell) {
    $(".manugdp").html("Manufacturing: " + norrell.value + "%");
  }});
  $("#infrgdp").slider({value: 4.4, min: 0.1, max: 100, step: 0.1, slide: function (bralan, avrey) {
    $(".infrgdp").html("Construction: " + avrey.value + "%");
  }});
  $("#agrgdp").slider({value: 1.4, min: 0.1, max: 100, step: 0.1, slide: function (siler, eyona) {
    $(".agrgdp").html("Agriculture: " + eyona.value + "%");
  }});
  $("#reagdp").slider({value: 8.8, min: 0.1, max: 100, step: 0.1, slide: function (kansas, theryn) {
    $(".reagdp").html("Real Estate: " + theryn.value + "%");
  }});
  $("#natgdp").slider({value: 2.6, min: 0.1, max: 100, step: 0.1, slide: function (eibhlin, suzon) {
    $(".natgdp").html("Natural Resources: " + suzon.value + "%");
  }});
  $("#gdpval").slider({value: 18e3, min: 100, max: 2e4, step: 0.1, slide: function (clive, larriah) {
    $(".gdpval").html("GDP Multiplier: " + larriah.value.toLocaleString());
  }});
  $("#pointz").slider({value: 100, min: 0, max: 100, step: 0.1, slide: function (luttie, getrude) {
    $(".pointz").html("Pointer Size: " + getrude.value + "%");
  }});
  $("#sov").change(function () {
    if ($("#sov").val() == 4) {
      $(".select2-selection__choice").addClass("deleter");
      $(".chooser").prop("disabled", true);
      $("#sov").prop("disabled", false);
      $(".slidz").slider("disable");
    } else {
      $(".chooser").prop("disabled", false);
      $(".slidz").slider("enable");
      $(".select2-selection__choice").removeClass("deleter");
      $("#centow").change(function () {
        if ($(this).val() == 2) {
          $("#centfun").val("").trigger("change.select2");
          $("#centfun").prop("disabled", true);
          $("#reserv").slider("value", 0);
          $(".reserv").html("Cash Reserve Ratio: 0%");
          $("#reserv").slider("disable");
        } else {
          $("#centfun").prop("disabled", false);
          $("#reserv").slider("enable");
        }
      }).trigger("change");
      $("#syse,#sysl,#sysj,#womrig").change(function () {
        if ($("#syse").val() >= 2 && $("#sysl").val() >= 2 && $("#sysj").val() >= 2) {
          $("#womrig").children("option[value=3]").prop("selected", false).trigger("change.select2");
          $("#votr").val(["0", "1", "2", "3"]).trigger("change.select2");
          $("#votr").prop("disabled", true);
        } else {
          $("#votr").prop("disabled", false);
        }
      }).trigger("change");
      $("#homogen").change(function () {
        if ($(this).val() >= 3) {
          $("#homoad").prop("disabled", true);
          $("#homoad").val("1").trigger("change.select2");
        } else {
          $("#homoad").prop("disabled", false);
        }
      }).trigger("change");
      $("#transgen").change(function () {
        if ($(this).val() >= 3) {
          $("#transad").prop("disabled", true);
          $("#transad").val("2").trigger("change.select2");
        } else {
          $("#transad").prop("disabled", false);
        }
      }).trigger("change");
      $("#minw").change(function () {
        if ($(this).val() == 2) {
          $("#minw2").prop("disabled", true);
          $("#minw2").val("1").trigger("change.select2");
        } else {
          $("#minw2").prop("disabled", false);
        }
      }).trigger("change");
      if ($(this).val() != 3) {
        $("#sovow").val("0").trigger("change.select2");
        $("#sovow").prop("disabled", true);
      }
    }
  }).trigger("change");
  $("#abort").change(function () {
    if ($(this).val()[0] == 0) {
      $(this).val(["0"]).trigger("change.select2");
    }
  }).trigger("change");
  $("#abort,#fabort").change(function () {
    for (i = 0; i < 4; i++) {
      if ($("#abort").val()[0] != 0 && $("#fabort").val()[i] == 1) {
        $("#abort").children("option[value=3]").prop("selected", true).trigger("change.select2");
      }
    }
  }).trigger("change");
  $("#govg,#syse").change(function () {
    if ($("#govg").val() == 1 && $("#syse").val() == 0) {
      $("#syse").val("1").trigger("change.select2");
    }
  }).trigger("change");
  $("#govc,#rel").change(function () {
    if ($("#govc").val() == 5 && ($("#rel").val() == 1 || $("#rel").val() == 0)) {
      $("#rel").val("2").trigger("change.select2");
    }
  }).trigger("change");
  $("#womrig").change(function () {
    var ninah = 0;
    for (i = 0; i < 5; i++) {
      if ($("#womrig").val()[i]) {
        var ninah = ninah + virginnia[$("#womrig").val()[i]].womrig;
      }
    }
    ;
    if (ninah > 0) {
      $("#womrig").children("option[value=4]").prop("selected", false).trigger("change.select2");
      $("#womrig").children("option[value=5]").prop("selected", false).trigger("change.select2");
    }
  }).trigger("change");
  var trelynn = {datasets: [{label: "My First dataset", xAxisID: "x-axis-1", yAxisID: "y-axis-1", data: [{x: 0, y: 0}]}]};
  $.each(trelynn.datasets, function (royanne, tanaijah) {
    tanaijah.borderColor = "hsla(0, 0%, 0%, 0)";
    tanaijah.backgroundColor = "hsla(0, 0%, 0%, 0)";
    tanaijah.pointBorderColor = "hsla(220, 6%, 20%, 0.85)";
    tanaijah.pointBackgroundColor = "hsla(220, 6%, 20%, 0.7)";
    tanaijah.pointHoverBackgroundColor = "hsla(220, 6%, 20%, 0.85)";
    tanaijah.pointRadius = 0;
    tanaijah.pointHitRadius = 0;
    tanaijah.pointHoverRadius = 0;
    tanaijah.pointBorderWidth = 0;
  });
  var yuchen = document.getElementById("mainer").getContext("2d");
  window.myScatter = Chart.Scatter(yuchen, {data: trelynn, options: {tooltips: {enabled: false, backgroundColor: "hsla(220, 6%, 5%, 0.79)"}, maintainAspectRatio: false, legend: {scaleShowVerticalLines: true, position: false}, responsive: true, hoverMode: "single", title: {display: false, text: "Filteries"}, scales: {xAxes: [{display: false, position: "bottom", gridLines: {zeroLineColor: "rgba(0,0,0,1)"}}], yAxes: [{type: "linear", display: false, position: "left", id: "y-axis-1"}, {type: "linear", display: false, position: "right", reverse: true, id: "y-axis-2", gridLines: {drawOnChartArea: false}}]}}});
  var nicasia = document.getElementById("mainer");
  var tangular = nicasia.getContext("2d");
  var keymara = $("#mainer");
  var lutricia = keymara.parent();
  keymara.width(lutricia.width());
  keymara.height(lutricia.width());
  var cetric = {data: {datasets: [{data: [50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50], borderWidth: 0.4, backgroundColor: "hsla(0, 0%, 74%, 0.2)", pointBackgroundColor: ["hsla(284, 82%, 41%, 0.7)", "hsla(333, 67%, 35%, 0.5)", "hsla(6, 72%, 47%, 0.5)", "hsla(30, 85%, 45%, 0.5)", "hsla(355, 82%, 41%, 0.7)", "hsla(55, 55%, 56%, 0.5)", "hsla(96, 60%, 65%, 0.5)", "hsla(121, 42%, 42%, 0.5)", "hsla(128, 82%, 41%, 0.7)", "hsla(164, 40%, 60%, 0.5)", "hsla(204, 42%, 54%, 0.5)", "hsla(240, 53%, 45%, 0.5)", "hsla(239, 82%, 41%, 0.7)", "hsla(259, 32%, 58%, 0.5)", "hsla(273, 42%, 46%, 0.5)", "hsla(301, 52%, 49%, 0.5)"], radius: 4, pointRadius: 4, pointHoverRadius: 6, pointHitRadius: 4}], labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""], infoz: ["Increases with policies that promote government", "Increases with policies that limit", "Increases with policies that promote", "Increases with policies that promote", "", "Increases with policies that promote", "Increases with policies that promote", "Increases with policies that promote", "Increases with policies that reduce government", "Increases with policies that promote", "Increases with policies that promote", "Increases with policies that promote", "", "Increases with policies that promote", "Increases with policies that promote", "Increases with policies that promote"], infoz2: ["control over social and economic matters", "civil or political rights", "the interests of native citizens", "family, religious or traditional values", "", "low public spending", "private ownership", "economic deregulations", "control over social and economic matters", "civil or political rights", "diverse communities", "secular or modern values", "", "high public spending", "public ownership", "economic regulations"]}, options: {tooltips: {callbacks: {label: function (annajames, taven) {
    var taelin = [taven.infoz[annajames.index]];
    taelin.push(taven.infoz2[annajames.index]);
    return taelin;
  }}, titleFontSize: 12, bodyFontSize: 11, backgroundColor: "hsla(220, 6%, 5%, 0.79)"}, responsive: true, maintainAspectRatio: false, legend: {display: false}, title: {display: false}, scale: {ticks: {beginAtZero: true, display: false}, reverse: false}, animation: {animateRotate: false, animateScale: true}}};
  var yuchen = document.getElementById("polarz");
  window.myPolarArea = Chart.Radar(yuchen, cetric);
  var zayneb = {labels: ["Government", "Education", "Media", "Finance", "Healthcare", "Retail", "Manufacturing", "Construction", "Agriculture", "Natural Resources", "Real Estate"], datasets: [{label: "Publicly Owned & Funded", backgroundColor: "hsla(273, 42%, 46%, 0.5)", borderWidth: 0, data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]}, {label: "Publicly Owned for Profit", backgroundColor: "hsla(259, 32%, 58%, 0.5)", data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]}, {label: "Privately Owned & Publicly Funded", backgroundColor: "hsla(30, 55%, 45%, 0.5)", data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]}, {label: "Privately Owned for Profit", backgroundColor: "hsla(55, 55%, 56%, 0.5)", data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]}]};
  var yuchen = document.getElementById("secter").getContext("2d");
  window.myHorizontalBar = new Chart(yuchen, {type: "horizontalBar", data: zayneb, options: {elements: {rectangle: {borderWidth: 0}}, responsive: false, elements: {rectangle: {borderColor: "#333", borderSkipped: "left"}}, responsive: true, maintainAspectRatio: false, legend: {position: "bottom", labels: {fontColor: "#aeaeb7", boxWidth: 3, fontSize: 11}}, scales: {xAxes: [{display: false, ticks: {}, stacked: true}], yAxes: [{ticks: {mirror: true}, categoryPercentage: 0.93, barPercentage: 1, stacked: true}]}, title: {display: false, text: "Sectors"}, tooltips: {backgroundColor: "hsla(220, 6%, 5%, 0.79)", bodyFontSize: 11, callbacks: {label: function (naihla, juwayria) {
    var rizelle = juwayria.datasets[naihla.datasetIndex].data[naihla.index] / (juwayria.datasets[0].data[naihla.index] + juwayria.datasets[1].data[naihla.index] + juwayria.datasets[2].data[naihla.index] + juwayria.datasets[3].data[naihla.index]) * 100;
    if (naihla.index < 1) {
      var lenville = 10;
    } else {
      var lenville = naihla.index - 1;
    }
    ;
    var azzurra = rizelle * daleisa[lenville].sectgdp / 100;
    var salmo = [juwayria.datasets[naihla.datasetIndex].label];
    salmo.push("$" + azzurra.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln");
    salmo.push(rizelle.toFixed() + "% of Sector");
    return salmo;
  }}}, scales: {xAxes: [{ticks: {}, stacked: true}], yAxes: [{ticks: {mirror: true}, categoryPercentage: 0.93, barPercentage: 1, stacked: true}]}}});
  var mucad = {type: "horizontalBar", data: {datasets: [{borderWidth: 1, data: [0, 0, 0, 0, 0, 0, 0, 0], gdpz: 0, id: ["Corporate Taxes", "Personal Taxes", "Consumption Taxes", "Import Tariffs", "Export Tariffs", "Inheritance Tax", "Real Estate", "Public Industries", "Other"], backgroundColor: ["hsla(12, 74%, 51%, 0.45)", "hsla(191, 74%, 51%, 0.45)", "hsla(263, 77%, 66%, 0.49)", "hsla(220, 77%, 62%, 0.55)", "hsla(83, 60%, 55%, 0.59)", "hsla(36, 74%, 51%, 0.45)", "hsla(214, 90%, 70%, 0.45)", "hsla(160, 74%, 51%, 0.45)", "hsla(219, 35%, 86%, 0.45)"], label: ""}], labels: ["Corporate Taxes", "Personal Taxes", "Consumption Taxes", "Import Tariffs", "Export Tariffs", "Inheritance Tax", "Real Estate", "Public Industries", "Other"]}, options: {responsive: true, maintainAspectRatio: false, legend: {display: false, position: "left", labels: {fontColor: "#aeaeb7", boxWidth: 8, fontSize: 11}}, scales: {xAxes: [{display: false, ticks: {}, stacked: true}], yAxes: [{ticks: {mirror: true}, categoryPercentage: 0.93, barPercentage: 1, stacked: true}]}, title: {display: true, text: "Income: "}, animation: {animateScale: false, animateRotate: true}, tooltips: {backgroundColor: "hsla(220, 6%, 5%, 0.79)", bodyFontSize: 11, callbacks: {label: function (khorie, gabiel) {
    var maryetta = ["$" + gabiel.datasets[0].data[khorie.index].toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln"];
    var kymera = gabiel.datasets[0].data[0] + gabiel.datasets[0].data[1] + gabiel.datasets[0].data[2] + gabiel.datasets[0].data[3] + gabiel.datasets[0].data[4] + gabiel.datasets[0].data[5] + gabiel.datasets[0].data[6] + gabiel.datasets[0].data[7];
    maryetta.push((gabiel.datasets[0].data[khorie.index] / kymera * 100).toFixed(1) + "% of Income  ");
    maryetta.push((gabiel.datasets[0].data[khorie.index] / gabiel.datasets[0].gdpz * 100).toFixed(1) + "% of GDP");
    return maryetta;
  }, title: function (malira, elen) {
    return elen.datasets[0].id[malira[0].index];
  }}}}};
  var yuchen = document.getElementById("pier").getContext("2d");
  window.myDoughnut = new Chart(yuchen, mucad);
  Chart.defaults.global.defaultFontColor = "#aeaeb7";
  var asbel = {type: "horizontalBar", data: {datasets: [{borderWidth: 1, data: [0, 0, 0, 0, 0, 0, 0], gdpz: 0, id: ["Military", "Welfare", "Education", "Science", "Environment", "Housing", "Industries", "Other"], backgroundColor: ["hsla(0, 74%, 51%, 0.45)", "hsla(250, 74%, 51%, 0.45)", "hsla(55, 74%, 51%, 0.45)", "hsla(220, 74%, 51%, 0.45)", "hsla(130, 74%, 51%, 0.45)", "hsla(214, 90%, 70%, 0.45)", "hsla(160, 74%, 51%, 0.45)", "hsla(219, 35%, 86%, 0.45)"], label: ""}], labels: ["Military", "Welfare", "Education", "Science", "Environment", "Housing", "Industries", "Other"]}, options: {responsive: true, maintainAspectRatio: false, legend: {display: false, position: "left", labels: {fontColor: "#aeaeb7", boxWidth: 8, fontSize: 11}}, scales: {xAxes: [{display: false, ticks: {}, stacked: true}], yAxes: [{ticks: {mirror: true}, categoryPercentage: 0.93, barPercentage: 1, stacked: true}]}, title: {display: true, text: "Spending: "}, animation: {animateScale: false, animateRotate: true}, tooltips: {backgroundColor: "hsla(220, 6%, 5%, 0.79)", bodyFontSize: 11, callbacks: {label: function (talae, dorace) {
    var maylah = ["$" + dorace.datasets[0].data[talae.index].toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln"];
    var madisin = dorace.datasets[0].data[0] + dorace.datasets[0].data[1] + dorace.datasets[0].data[2] + dorace.datasets[0].data[3] + dorace.datasets[0].data[4] + dorace.datasets[0].data[5] + dorace.datasets[0].data[6];
    maylah.push((dorace.datasets[0].data[talae.index] / madisin * 100).toFixed(1) + "% of Spending");
    maylah.push((dorace.datasets[0].data[talae.index] / dorace.datasets[0].gdpz * 100).toFixed(1) + "% of GDP");
    return maylah;
  }, title: function (fjolla, jacquleen) {
    return jacquleen.datasets[0].id[fjolla[0].index];
  }}}}};
  var yuchen = document.getElementById("pier2").getContext("2d");
  window.myDoughnut2 = new Chart(yuchen, asbel);
  Chart.defaults.global.defaultFontColor = "#aeaeb7";
  function brynda() {
    $.each(trelynn.datasets, function (zayli, terralyn) {
      terralyn.pointRadius = $("#pointz").slider("value") / 12;
      terralyn.pointHoverRadius = $("#pointz").slider("value") / 12;
    });
    $("#mainer").css("background-image", "url(" + kellon[0].shadz + "),url(" + kellon[$("#linez").val()].linez + "),url(" + kellon[$("#lblz").val()].lblz + "),url(" + kellon[$("#chaz").val()].chaz + ")");
    $("#mainer").css("transition", "0.35s");
    if ($("#tooler").val() == 1) {
      $("*").qtip("disable");
    } else {
      if ($("#tooler").val() == 0) {
        $("*").qtip("enable");
      }
    }
    ;
    if ($("#imman").slider("value") == 0) {
      $("#entreq").val(["0", "1", "2", "3"]).trigger("change.select2");
      $("#entreq").prop("disabled", true);
      $("#immst").slider("disable");
      $("#immwo").slider("disable");
      $("#immas").slider("disable");
      $("#immref").slider("disable");
    } else {
      if ($("#sov").val() != 4 && $("#imman").slider("value") != 0) {
        $("#entreq").prop("disabled", false);
        $("#immst").slider("enable");
        $("#immwo").slider("enable");
        $("#immas").slider("enable");
        $("#immref").slider("enable");
      }
    }
    ;
    var kohlten = $("#sov").val();
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      if ($("#" + daleisa[gotham].id + "ow").slider("value") == 100) {
        $("#" + daleisa[gotham].id + "fun").slider("disable");
        $("#" + daleisa[gotham].id + "inc").slider("disable");
        $("#" + daleisa[gotham].id + "cor").slider("disable");
        $("#" + daleisa[gotham].id + "cons").slider("disable");
        $("#" + daleisa[gotham].id + "imp").slider("disable");
        $("#" + daleisa[gotham].id + "exp").slider("disable");
      } else {
        if (kohlten != 4) {
          $("#" + daleisa[gotham].id + "fun").slider("enable");
          $("#" + daleisa[gotham].id + "inc").slider("enable");
          $("#" + daleisa[gotham].id + "cor").slider("enable");
          $("#" + daleisa[gotham].id + "cons").slider("enable");
          $("#" + daleisa[gotham].id + "imp").slider("enable");
          $("#" + daleisa[gotham].id + "exp").slider("enable");
        }
      }
      ;
      if ($("#" + daleisa[gotham].id + "ow").slider("value") == 0) {
        $("#" + daleisa[gotham].id + "prc").slider("disable");
        $("#" + daleisa[gotham].id + "wag").slider("disable");
        $("#" + daleisa[gotham].id + "wagr").slider("disable");
        $("#" + daleisa[gotham].id + "pex").slider("disable");
      } else {
        if (kohlten != 4) {
          $("#" + daleisa[gotham].id + "prc").slider("enable");
          $("#" + daleisa[gotham].id + "wag").slider("enable");
          $("#" + daleisa[gotham].id + "wagr").slider("enable");
          $("#" + daleisa[gotham].id + "pex").slider("enable");
        }
      }
      ;
      if ($("#" + daleisa[gotham].id + "wag").slider("value") == -100) {
        $("#" + daleisa[gotham].id + "wagr").slider("disable");
      } else {
        if ($("#" + daleisa[gotham].id + "ow").slider("value") != 0 && kohlten != 4) {
          $("#" + daleisa[gotham].id + "wagr").slider("enable");
        }
      }
      ;
      if ($("#" + daleisa[gotham].id + "fun").slider("value") == 100) {
        $("#" + daleisa[gotham].id + "inc").slider("disable");
        $("#" + daleisa[gotham].id + "cor").slider("disable");
        $("#" + daleisa[gotham].id + "imp").slider("disable");
        $("#" + daleisa[gotham].id + "exp").slider("disable");
      } else {
        if ($("#" + daleisa[gotham].id + "ow").slider("value") != 100 && kohlten != 4) {
          $("#" + daleisa[gotham].id + "inc").slider("enable");
          $("#" + daleisa[gotham].id + "cor").slider("enable");
          $("#" + daleisa[gotham].id + "imp").slider("enable");
          $("#" + daleisa[gotham].id + "exp").slider("enable");
        }
      }
      ;
      if ($("#" + daleisa[gotham].id + "cor").slider("values", 0) == 100 && $("#" + daleisa[gotham].id + "cor").slider("values", 1) == 100) {
        $("#" + daleisa[gotham].id + "exp").slider("disable");
      } else {
        if ($("#" + daleisa[gotham].id + "ow").slider("value") != 100 && $("#" + daleisa[gotham].id + "fun").slider("value") != 100 && kohlten != 4) {
          $("#" + daleisa[gotham].id + "cor").slider("enable");
        }
      }
    }
    ;
    if ($("#reaow").slider("value") == 100) {
      $("#reareg0").slider("disable");
      $("#reareg1").slider("disable");
      $("#reareg2").slider("disable");
      $("#reareg3").slider("disable");
      $("#reareg4").slider("disable");
    } else {
      if (kohlten != 4) {
        $("#reareg0").slider("enable");
        $("#reareg1").slider("enable");
        $("#reareg2").slider("enable");
        $("#reareg3").slider("enable");
        $("#reareg4").slider("enable");
      }
    }
    ;
    if ($("#reaow").slider("value") == 0) {
      $("#reacom1").slider("disable");
      $("#reacom2").slider("disable");
    } else {
      if (kohlten != 4) {
        $("#reacom1").slider("enable");
        $("#reacom2").slider("enable");
      }
    }
    ;
    var bradrick = $("#mifu").slider("value");
    var andalyn = $("#imman").slider("value");
    var beatha = $("#immst").slider("value");
    var mija = $("#immwo").slider("value");
    var edman = $("#immas").slider("value");
    var elyzza = $("#immref").slider("value");
    var octavian = $("#reserv").slider("value");
    var katrice = $("#pover").slider("value");
    var faylyn = $("#unemp").slider("value");
    var oberia = $("#pens").slider("value");
    var juliocesar = $("#mininc").slider("value");
    var sincear = $("#basinc").slider("value");
    var chaylynn = $("#wast").slider("value");
    var dwania = $("#pubpa").slider("value");
    var arlease = $("#conser").slider("value");
    var fawzi = $("#solar").slider("value");
    var jahkor = $("#nucl").slider("value");
    var gracyn = $("#inher").slider("values", 0);
    var charmisa = $("#inher").slider("values", 1);
    var alicemae = $("#rnd").slider("value");
    var cheo = $("#gdpval").slider("value");
    var skylaar = $("#edugdp").slider("value");
    var lyjah = $("#medgdp").slider("value");
    var ailena = $("#bankgdp").slider("value");
    var can = $("#heagdp").slider("value");
    var jakhiya = $("#retgdp").slider("value");
    var cythina = $("#manugdp").slider("value");
    var justyce = $("#infrgdp").slider("value");
    var latronya = $("#agrgdp").slider("value");
    var fredrik = $("#reagdp").slider("value");
    var darletta = $("#natgdp").slider("value");
    daleisa[0].sectgdpprc = $("#edugdp").slider("value");
    daleisa[1].sectgdpprc = $("#medgdp").slider("value");
    daleisa[2].sectgdpprc = $("#bankgdp").slider("value");
    daleisa[3].sectgdpprc = $("#heagdp").slider("value");
    daleisa[4].sectgdpprc = $("#retgdp").slider("value");
    daleisa[5].sectgdpprc = $("#manugdp").slider("value");
    daleisa[6].sectgdpprc = $("#infrgdp").slider("value");
    daleisa[7].sectgdpprc = $("#agrgdp").slider("value");
    daleisa[8].sectgdpprc = $("#natgdp").slider("value");
    daleisa[9].sectgdpprc = $("#reagdp").slider("value");
    daleisa[0].ownz = $("#eduow").slider("value");
    daleisa[0].funz = $("#edufun").slider("value");
    daleisa[0].incz = $("#eduinc").slider("values", 0);
    daleisa[0].incz2 = $("#eduinc").slider("values", 1);
    daleisa[0].corz = $("#educor").slider("values", 0);
    daleisa[0].corz2 = $("#educor").slider("values", 1);
    daleisa[0].consz = $("#educons").slider("value");
    daleisa[0].impz = $("#eduimp").slider("value");
    daleisa[0].expz = $("#eduexp").slider("value");
    daleisa[1].ownz = $("#medow").slider("value");
    daleisa[1].funz = $("#medfun").slider("value");
    daleisa[1].incz = $("#medinc").slider("values", 0);
    daleisa[1].incz2 = $("#medinc").slider("values", 1);
    daleisa[1].corz = $("#medcor").slider("values", 0);
    daleisa[1].corz2 = $("#medcor").slider("values", 1);
    daleisa[1].consz = $("#medcons").slider("value");
    daleisa[1].impz = $("#medimp").slider("value");
    daleisa[1].expz = $("#medexp").slider("value");
    daleisa[2].ownz = $("#bankow").slider("value");
    daleisa[2].funz = $("#bankfun").slider("value");
    daleisa[2].incz = $("#bankinc").slider("values", 0);
    daleisa[2].incz2 = $("#bankinc").slider("values", 1);
    daleisa[2].corz = $("#bankcor").slider("values", 0);
    daleisa[2].corz2 = $("#bankcor").slider("values", 1);
    daleisa[2].consz = $("#bankcons").slider("value");
    daleisa[2].impz = $("#bankimp").slider("value");
    daleisa[2].expz = $("#bankexp").slider("value");
    daleisa[3].ownz = $("#heaow").slider("value");
    daleisa[3].funz = $("#heafun").slider("value");
    daleisa[3].incz = $("#heainc").slider("values", 0);
    daleisa[3].incz2 = $("#heainc").slider("values", 1);
    daleisa[3].corz = $("#heacor").slider("values", 0);
    daleisa[3].corz2 = $("#heacor").slider("values", 1);
    daleisa[3].consz = $("#heacons").slider("value");
    daleisa[3].impz = $("#heaimp").slider("value");
    daleisa[3].expz = $("#heaexp").slider("value");
    daleisa[4].ownz = $("#retow").slider("value");
    daleisa[4].funz = $("#retfun").slider("value");
    daleisa[4].incz = $("#retinc").slider("values", 0);
    daleisa[4].incz2 = $("#retinc").slider("values", 1);
    daleisa[4].corz = $("#retcor").slider("values", 0);
    daleisa[4].corz2 = $("#retcor").slider("values", 1);
    daleisa[4].consz = $("#retcons").slider("value");
    daleisa[4].impz = $("#retimp").slider("value");
    daleisa[4].expz = $("#retexp").slider("value");
    daleisa[5].ownz = $("#manuow").slider("value");
    daleisa[5].funz = $("#manufun").slider("value");
    daleisa[5].incz = $("#manuinc").slider("values", 0);
    daleisa[5].incz2 = $("#manuinc").slider("values", 1);
    daleisa[5].corz = $("#manucor").slider("values", 0);
    daleisa[5].corz2 = $("#manucor").slider("values", 1);
    daleisa[5].consz = $("#manucons").slider("value");
    daleisa[5].impz = $("#manuimp").slider("value");
    daleisa[5].expz = $("#manuexp").slider("value");
    daleisa[6].ownz = $("#infrow").slider("value");
    daleisa[6].funz = $("#infrfun").slider("value");
    daleisa[6].incz = $("#infrinc").slider("values", 0);
    daleisa[6].incz2 = $("#infrinc").slider("values", 1);
    daleisa[6].corz = $("#infrcor").slider("values", 0);
    daleisa[6].corz2 = $("#infrcor").slider("values", 1);
    daleisa[6].consz = $("#infrcons").slider("value");
    daleisa[6].impz = $("#infrimp").slider("value");
    daleisa[6].expz = $("#infrexp").slider("value");
    daleisa[7].ownz = $("#agrow").slider("value");
    daleisa[7].funz = $("#agrfun").slider("value");
    daleisa[7].incz = $("#agrinc").slider("values", 0);
    daleisa[7].incz2 = $("#agrinc").slider("values", 1);
    daleisa[7].corz = $("#agrcor").slider("values", 0);
    daleisa[7].corz2 = $("#agrcor").slider("values", 1);
    daleisa[7].consz = $("#agrcons").slider("value");
    daleisa[7].impz = $("#agrimp").slider("value");
    daleisa[7].expz = $("#agrexp").slider("value");
    daleisa[8].ownz = $("#natow").slider("value");
    daleisa[8].funz = $("#natfun").slider("value");
    daleisa[8].incz = $("#natinc").slider("values", 0);
    daleisa[8].incz2 = $("#natinc").slider("values", 1);
    daleisa[8].corz = $("#natcor").slider("values", 0);
    daleisa[8].corz2 = $("#natcor").slider("values", 1);
    daleisa[8].consz = $("#natcons").slider("value");
    daleisa[8].impz = $("#natimp").slider("value");
    daleisa[8].expz = $("#natexp").slider("value");
    var wesleigh = $("#reaow").slider("value");
    var kemeshia = $("#reareg0").slider("value");
    var nitosha = $("#reareg1").slider("value");
    var ignazio = $("#reareg2").slider("value");
    var makaylen = $("#reareg3").slider("value");
    var tilly = $("#reareg4").slider("value");
    var amirra = $("#reacom1").slider("value");
    var blayne = $("#reacom2").slider("value");
    daleisa[0].prcx = $("#eduprc").slider("value");
    daleisa[1].prcx = $("#medprc").slider("value");
    daleisa[2].prcx = $("#bankprc").slider("value");
    daleisa[3].prcx = $("#heaprc").slider("value");
    daleisa[4].prcx = $("#retprc").slider("value");
    daleisa[5].prcx = $("#manuprc").slider("value");
    daleisa[6].prcx = $("#infrprc").slider("value");
    daleisa[7].prcx = $("#agrprc").slider("value");
    daleisa[8].prcx = $("#natprc").slider("value");
    daleisa[0].wagx = $("#eduwag").slider("value");
    daleisa[1].wagx = $("#medwag").slider("value");
    daleisa[2].wagx = $("#bankwag").slider("value");
    daleisa[3].wagx = $("#heawag").slider("value");
    daleisa[4].wagx = $("#retwag").slider("value");
    daleisa[5].wagx = $("#manuwag").slider("value");
    daleisa[6].wagx = $("#infrwag").slider("value");
    daleisa[7].wagx = $("#agrwag").slider("value");
    daleisa[8].wagx = $("#natwag").slider("value");
    daleisa[0].wagrx = $("#eduwagr").slider("value");
    daleisa[1].wagrx = $("#medwagr").slider("value");
    daleisa[2].wagrx = $("#bankwagr").slider("value");
    daleisa[3].wagrx = $("#heawagr").slider("value");
    daleisa[4].wagrx = $("#retwagr").slider("value");
    daleisa[5].wagrx = $("#manuwagr").slider("value");
    daleisa[6].wagrx = $("#infrwagr").slider("value");
    daleisa[7].wagrx = $("#agrwagr").slider("value");
    daleisa[8].wagrx = $("#natwagr").slider("value");
    var hartly = $("#allsow").slider("value");
    var mavery = $("#allsfun").slider("value");
    var juansebastian = $("#allsinc").slider("values", 0);
    var kolsen = $("#allsinc").slider("values", 1);
    var zyniah = $("#allscor").slider("values", 0);
    var lorde = $("#allscor").slider("values", 1);
    var ece = $("#allscons").slider("value");
    var kartrina = $("#allsimp").slider("value");
    var lurleen = $("#allsexp").slider("value");
    var kohlten = $("#sov").val();
    var tanushree = $("#sovow").val();
    var tango = $("#auto").val();
    var mayeli = $("#govg").val();
    var cheetara = $("#govc").val();
    var mikenzy = $("#syse").val();
    var jeyline = $("#sysl").val();
    var yulia = $("#sysj").val();
    var creosha = $("#rel").val();
    var francess = $("#for").val();
    var maksymilian = $("#cons").val();
    var marchia = $("#righ").val();
    var daeqwon = $("#minw").val();
    var ludy = $("#minw2").val();
    var robertta = $("#pensreg").val();
    var wandalee = $("#centow").val();
    var synai = $("#murd").val();
    var nhut = $("#rape").val();
    var cirilo = $("#steal").val();
    var kaiyan = $("#child").val();
    var rasheeta = $("#defa").val();
    var alazaya = $("#incit").val();
    var payzley = $("#stprost").val();
    var absalom = $("#broth").val();
    var mihajlo = $("#esco").val();
    var ortrude = $("#hand").val();
    var khaira = $("#shot").val();
    var tyrik = $("#rifle").val();
    var yobani = $("#casin").val();
    var tishonna = $("#oncasin").val();
    var cyrelle = $("#sports").val();
    var annorah = $("#homogen").val();
    var absalat = $("#homoad").val();
    var ambrasia = $("#transgen").val();
    var leomar = $("#transad").val();
    var daisye = $("#tobus").val();
    var garry = $("#tobsel").val();
    var cleta = $("#alcus").val();
    var tanysha = $("#alcsel").val();
    var zuriya = $("#canus").val();
    var symari = $("#cansel").val();
    var sahmiyah = $("#psyus").val();
    var feliciana = $("#psysel").val();
    var jerren = $("#stius").val();
    var jaquayla = $("#stisel").val();
    var egypt = $("#opius").val();
    var chrisa = $("#opisel").val();
    var anjanie = $("#euth").val();
    var tanisha = $("#obsc").val();
    var zenorah = $("#warc").val();
    var esven = $("#corf").val();
    var cadem = $("#blasph").val();
    var rodeny = $("#treas").val();
    var athenamarie = $("#embe").val();
    var koichi = $("#misce").val();
    var trafton = $("#disse").val();
    var shatara = $("#votr").val() || [];
    var pashion = $("#entreq").val() || [];
    var seph = $("#envreg").val() || [];
    var kaylia = $("#womrig").val() || [];
    var antown = $("#centfun").val() || [];
    var crissandra = $("#abort").val() || [];
    var nellean = $("#fabort").val() || [];
    var seona = beatha + mija + edman + elyzza;
    if (seona == 0) {
      var seona = 1;
    }
    ;
    $("#immst").slider("value", beatha * 100 / seona);
    $("#immwo").slider("value", mija * 100 / seona);
    $("#immas").slider("value", edman * 100 / seona);
    $("#immref").slider("value", elyzza * 100 / seona);
    $(".immst").html("Students: " + Math.round(beatha * 100 / seona).toFixed(0) + "%");
    $(".immwo").html("Workers: " + Math.round(mija * 100 / seona).toFixed(0) + "%");
    $(".immas").html("Asylees: " + Math.round(edman * 100 / seona).toFixed(0) + "%");
    $(".immref").html("Refugees: " + Math.round(elyzza * 100 / seona).toFixed(0) + "%");
    var leahrae = 4;
    var onassis = 0;
    if (andalyn == 2.5) {
      var leahrae = 2.5;
    } else {
      if (andalyn == 0) {
        var onassis = kaymon[0].imman;
      }
    }
    ;
    var tanikka = onassis + andalyn / leahrae * kaymon[2].imman * (beatha / 100 * kaymon[2].immst + mija / 100 * kaymon[2].immwo + edman / 100 * kaymon[2].immas + elyzza / 100 * kaymon[2].immref);
    kaymon[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        kaymon[7].votr = kaymon[7].votr + +kaymon[shatara[gotham]].votr;
      }
    }
    ;
    kaymon[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        kaymon[7].entreq = kaymon[7].entreq + +kaymon[pashion[gotham]].entreq;
      }
    }
    ;
    kaymon[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        kaymon[7].envreg = kaymon[7].envreg + +kaymon[seph[gotham]].envreg;
      }
    }
    ;
    kaymon[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        kaymon[7].womrig = kaymon[7].womrig + +kaymon[kaylia[gotham]].womrig;
      }
    }
    ;
    kaymon[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        kaymon[7].centfun = kaymon[7].centfun + +kaymon[antown[gotham]].centfun;
      }
    }
    ;
    kaymon[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        kaymon[7].abort = kaymon[7].abort + +kaymon[crissandra[gotham]].abort;
      }
    }
    ;
    kaymon[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        kaymon[7].fabort = kaymon[7].fabort + +kaymon[nellean[gotham]].fabort;
      }
    }
    ;
    var tramane = tanikka + kaymon[kohlten].sov + kaymon[tango].auto + kaymon[mayeli].govg + kaymon[cheetara].govc + kaymon[mikenzy].syse + kaymon[jeyline].sysl + kaymon[yulia].sysj + kaymon[creosha].rel + kaymon[francess].for + kaymon[maksymilian].cons + kaymon[marchia].righ + kaymon[daeqwon].minw + kaymon[ludy].minw2 + kaymon[robertta].pensreg + kaymon[wandalee].centow + kaymon[synai].murd + kaymon[nhut].rape + kaymon[cirilo].steal + kaymon[kaiyan].child + kaymon[rasheeta].defa + kaymon[alazaya].incit + kaymon[payzley].stprost + kaymon[absalom].broth + kaymon[mihajlo].esco + kaymon[ortrude].hand + kaymon[khaira].shot + kaymon[tyrik].rifle + kaymon[yobani].casin + kaymon[tishonna].oncasin + kaymon[cyrelle].sports + kaymon[annorah].homogen + kaymon[absalat].homoad + kaymon[ambrasia].transgen + kaymon[leomar].transad + kaymon[daisye].tobus + kaymon[garry].tobsel + kaymon[cleta].alcus + kaymon[tanysha].alcsel + kaymon[zuriya].canus + kaymon[symari].cansel + kaymon[sahmiyah].psyus + kaymon[feliciana].psysel + kaymon[jerren].stius + kaymon[jaquayla].stisel + kaymon[egypt].opius + kaymon[chrisa].opisel + kaymon[anjanie].euth + kaymon[tanisha].obsc + kaymon[zenorah].warc + kaymon[esven].corf + kaymon[cadem].blasph + kaymon[rodeny].treas + kaymon[athenamarie].embe + kaymon[koichi].misce + kaymon[trafton].disse + bradrick / 100 * kaymon[2].mifu + gracyn / 200 * kaymon[2].inher + charmisa / 200 * kaymon[2].inher + octavian / 100 * kaymon[2].reserv + katrice / 100 * kaymon[2].pover + faylyn / 100 * kaymon[2].unemp + oberia / 100 * kaymon[2].pens + juliocesar / 100 * kaymon[2].mininc + sincear / 100 * kaymon[2].basinc + chaylynn / 100 * kaymon[2].wast + dwania / 100 * kaymon[2].pubpa + arlease / 100 * kaymon[2].conser + fawzi / 100 * kaymon[2].solar + jahkor / 100 * kaymon[2].nucl + alicemae / 100 * kaymon[2].rnd + kaymon[7].votr + kaymon[7].entreq + kaymon[7].envreg + kaymon[7].womrig + kaymon[7].centfun + kaymon[7].abort + kaymon[7].fabort;
    var maraiah = 4;
    var shyloe = 0;
    if (andalyn == 2.5) {
      var maraiah = 2.5;
    } else {
      if (andalyn == 0) {
        var shyloe = taariq[0].imman;
      }
    }
    ;
    var zarious = shyloe + andalyn / maraiah * taariq[2].imman * (beatha / 100 * taariq[2].immst + mija / 100 * taariq[2].immwo + edman / 100 * taariq[2].immas + elyzza / 100 * taariq[2].immref);
    taariq[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        taariq[7].votr = taariq[7].votr + +taariq[shatara[gotham]].votr;
      }
    }
    ;
    taariq[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        taariq[7].entreq = taariq[7].entreq + +taariq[pashion[gotham]].entreq;
      }
    }
    ;
    taariq[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        taariq[7].envreg = taariq[7].envreg + +taariq[seph[gotham]].envreg;
      }
    }
    ;
    taariq[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        taariq[7].womrig = taariq[7].womrig + +taariq[kaylia[gotham]].womrig;
      }
    }
    ;
    taariq[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        taariq[7].centfun = taariq[7].centfun + +taariq[antown[gotham]].centfun;
      }
    }
    ;
    taariq[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        taariq[7].abort = taariq[7].abort + +taariq[crissandra[gotham]].abort;
      }
    }
    ;
    taariq[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        taariq[7].fabort = taariq[7].fabort + +taariq[nellean[gotham]].fabort;
      }
    }
    ;
    var zafer = zarious + taariq[kohlten].sov + taariq[tango].auto + taariq[mayeli].govg + taariq[cheetara].govc + taariq[mikenzy].syse + taariq[jeyline].sysl + taariq[yulia].sysj + taariq[creosha].rel + taariq[francess].for + taariq[maksymilian].cons + taariq[marchia].righ + taariq[daeqwon].minw + taariq[ludy].minw2 + taariq[robertta].pensreg + taariq[wandalee].centow + taariq[synai].murd + taariq[nhut].rape + taariq[cirilo].steal + taariq[kaiyan].child + taariq[rasheeta].defa + taariq[alazaya].incit + taariq[payzley].stprost + taariq[absalom].broth + taariq[mihajlo].esco + taariq[ortrude].hand + taariq[khaira].shot + taariq[tyrik].rifle + taariq[yobani].casin + taariq[tishonna].oncasin + taariq[cyrelle].sports + taariq[annorah].homogen + taariq[absalat].homoad + taariq[ambrasia].transgen + taariq[leomar].transad + taariq[daisye].tobus + taariq[garry].tobsel + taariq[cleta].alcus + taariq[tanysha].alcsel + taariq[zuriya].canus + taariq[symari].cansel + taariq[sahmiyah].psyus + taariq[feliciana].psysel + taariq[jerren].stius + taariq[jaquayla].stisel + taariq[egypt].opius + taariq[chrisa].opisel + taariq[anjanie].euth + taariq[tanisha].obsc + taariq[zenorah].warc + taariq[esven].corf + taariq[cadem].blasph + taariq[rodeny].treas + taariq[athenamarie].embe + taariq[koichi].misce + taariq[trafton].disse + bradrick / 100 * taariq[2].mifu + gracyn / 200 * taariq[2].inher + charmisa / 200 * taariq[2].inher + octavian / 100 * taariq[2].reserv + katrice / 100 * taariq[2].pover + faylyn / 100 * taariq[2].unemp + oberia / 100 * taariq[2].pens + juliocesar / 100 * taariq[2].mininc + sincear / 100 * taariq[2].basinc + chaylynn / 100 * taariq[2].wast + dwania / 100 * taariq[2].pubpa + arlease / 100 * taariq[2].conser + fawzi / 100 * taariq[2].solar + jahkor / 100 * taariq[2].nucl + alicemae / 100 * taariq[2].rnd + taariq[7].votr + taariq[7].entreq + taariq[7].envreg + taariq[7].womrig + taariq[7].centfun + taariq[7].abort + taariq[7].fabort;
    var axiom = 4;
    var toussaint = 0;
    if (andalyn == 2.5) {
      var axiom = 2.5;
    } else {
      if (andalyn == 0) {
        var toussaint = lakley[0].imman;
      }
    }
    ;
    var tuson = toussaint + andalyn / axiom * lakley[2].imman * (beatha / 100 * lakley[2].immst + mija / 100 * lakley[2].immwo + edman / 100 * lakley[2].immas + elyzza / 100 * lakley[2].immref);
    lakley[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        lakley[7].votr = lakley[7].votr + +lakley[shatara[gotham]].votr;
      }
    }
    ;
    lakley[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        lakley[7].entreq = lakley[7].entreq + +lakley[pashion[gotham]].entreq;
      }
    }
    ;
    lakley[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        lakley[7].envreg = lakley[7].envreg + +lakley[seph[gotham]].envreg;
      }
    }
    ;
    lakley[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        lakley[7].womrig = lakley[7].womrig + +lakley[kaylia[gotham]].womrig;
      }
    }
    ;
    lakley[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        lakley[7].centfun = lakley[7].centfun + +lakley[antown[gotham]].centfun;
      }
    }
    ;
    lakley[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        lakley[7].abort = lakley[7].abort + +lakley[crissandra[gotham]].abort;
      }
    }
    ;
    lakley[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        lakley[7].fabort = lakley[7].fabort + +lakley[nellean[gotham]].fabort;
      }
    }
    ;
    var leiyah = tuson + lakley[kohlten].sov + lakley[tango].auto + lakley[mayeli].govg + lakley[cheetara].govc + lakley[mikenzy].syse + lakley[jeyline].sysl + lakley[yulia].sysj + lakley[creosha].rel + lakley[francess].for + lakley[maksymilian].cons + lakley[marchia].righ + lakley[daeqwon].minw + lakley[ludy].minw2 + lakley[robertta].pensreg + lakley[wandalee].centow + lakley[synai].murd + lakley[nhut].rape + lakley[cirilo].steal + lakley[kaiyan].child + lakley[rasheeta].defa + lakley[alazaya].incit + lakley[payzley].stprost + lakley[absalom].broth + lakley[mihajlo].esco + lakley[ortrude].hand + lakley[khaira].shot + lakley[tyrik].rifle + lakley[yobani].casin + lakley[tishonna].oncasin + lakley[cyrelle].sports + lakley[annorah].homogen + lakley[absalat].homoad + lakley[ambrasia].transgen + lakley[leomar].transad + lakley[daisye].tobus + lakley[garry].tobsel + lakley[cleta].alcus + lakley[tanysha].alcsel + lakley[zuriya].canus + lakley[symari].cansel + lakley[sahmiyah].psyus + lakley[feliciana].psysel + lakley[jerren].stius + lakley[jaquayla].stisel + lakley[egypt].opius + lakley[chrisa].opisel + lakley[anjanie].euth + lakley[tanisha].obsc + lakley[zenorah].warc + lakley[esven].corf + lakley[cadem].blasph + lakley[rodeny].treas + lakley[athenamarie].embe + lakley[koichi].misce + lakley[trafton].disse + bradrick / 100 * lakley[2].mifu + gracyn / 200 * lakley[2].inher + charmisa / 200 * lakley[2].inher + octavian / 100 * lakley[2].reserv + katrice / 100 * lakley[2].pover + faylyn / 100 * lakley[2].unemp + oberia / 100 * lakley[2].pens + juliocesar / 100 * lakley[2].mininc + sincear / 100 * lakley[2].basinc + chaylynn / 100 * lakley[2].wast + dwania / 100 * lakley[2].pubpa + arlease / 100 * lakley[2].conser + fawzi / 100 * lakley[2].solar + jahkor / 100 * lakley[2].nucl + alicemae / 100 * lakley[2].rnd + lakley[7].votr + lakley[7].entreq + lakley[7].envreg + lakley[7].womrig + lakley[7].centfun + lakley[7].abort + lakley[7].fabort;
    var leiyah = leiyah * 0.96 + daleisa[1].ownz * 0.04;
    var joriann = 4;
    var giuliani = 0;
    if (andalyn == 2.5) {
      var joriann = 2.5;
    } else {
      if (andalyn == 0) {
        var giuliani = damontray[0].imman;
      }
    }
    ;
    var omani = giuliani + andalyn / joriann * damontray[2].imman * (beatha / 100 * damontray[2].immst + mija / 100 * damontray[2].immwo + edman / 100 * damontray[2].immas + elyzza / 100 * damontray[2].immref);
    damontray[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        damontray[7].votr = damontray[7].votr + +damontray[shatara[gotham]].votr;
      }
    }
    ;
    damontray[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        damontray[7].entreq = damontray[7].entreq + +damontray[pashion[gotham]].entreq;
      }
    }
    ;
    damontray[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        damontray[7].envreg = damontray[7].envreg + +damontray[seph[gotham]].envreg;
      }
    }
    ;
    damontray[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        damontray[7].womrig = damontray[7].womrig + +damontray[kaylia[gotham]].womrig;
      }
    }
    ;
    damontray[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        damontray[7].centfun = damontray[7].centfun + +damontray[antown[gotham]].centfun;
      }
    }
    ;
    damontray[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        damontray[7].abort = damontray[7].abort + +damontray[crissandra[gotham]].abort;
      }
    }
    ;
    damontray[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        damontray[7].fabort = damontray[7].fabort + +damontray[nellean[gotham]].fabort;
      }
    }
    ;
    var mehrdad = omani + damontray[kohlten].sov + damontray[tango].auto + damontray[mayeli].govg + damontray[cheetara].govc + damontray[mikenzy].syse + damontray[jeyline].sysl + damontray[yulia].sysj + damontray[creosha].rel + damontray[francess].for + damontray[maksymilian].cons + damontray[marchia].righ + damontray[daeqwon].minw + damontray[ludy].minw2 + damontray[robertta].pensreg + damontray[wandalee].centow + damontray[synai].murd + damontray[nhut].rape + damontray[cirilo].steal + damontray[kaiyan].child + damontray[rasheeta].defa + damontray[alazaya].incit + damontray[payzley].stprost + damontray[absalom].broth + damontray[mihajlo].esco + damontray[ortrude].hand + damontray[khaira].shot + damontray[tyrik].rifle + damontray[yobani].casin + damontray[tishonna].oncasin + damontray[cyrelle].sports + damontray[annorah].homogen + damontray[absalat].homoad + damontray[ambrasia].transgen + damontray[leomar].transad + damontray[daisye].tobus + damontray[garry].tobsel + damontray[cleta].alcus + damontray[tanysha].alcsel + damontray[zuriya].canus + damontray[symari].cansel + damontray[sahmiyah].psyus + damontray[feliciana].psysel + damontray[jerren].stius + damontray[jaquayla].stisel + damontray[egypt].opius + damontray[chrisa].opisel + damontray[anjanie].euth + damontray[tanisha].obsc + damontray[zenorah].warc + damontray[esven].corf + damontray[cadem].blasph + damontray[rodeny].treas + damontray[athenamarie].embe + damontray[koichi].misce + damontray[trafton].disse + bradrick / 100 * damontray[2].mifu + gracyn / 200 * damontray[2].inher + charmisa / 200 * damontray[2].inher + octavian / 100 * damontray[2].reserv + katrice / 100 * damontray[2].pover + faylyn / 100 * damontray[2].unemp + oberia / 100 * damontray[2].pens + juliocesar / 100 * damontray[2].mininc + sincear / 100 * damontray[2].basinc + chaylynn / 100 * damontray[2].wast + dwania / 100 * damontray[2].pubpa + arlease / 100 * damontray[2].conser + fawzi / 100 * damontray[2].solar + jahkor / 100 * damontray[2].nucl + alicemae / 100 * damontray[2].rnd + damontray[7].votr + damontray[7].entreq + damontray[7].envreg + damontray[7].womrig + damontray[7].centfun + damontray[7].abort + damontray[7].fabort;
    var trayvin = 4;
    var cayo = 0;
    if (andalyn == 2.5) {
      var trayvin = 2.5;
    } else {
      if (andalyn == 0) {
        var cayo = neya[0].imman;
      }
    }
    ;
    var hedrick = cayo + andalyn / trayvin * neya[2].imman * (beatha / 100 * neya[2].immst + mija / 100 * neya[2].immwo + edman / 100 * neya[2].immas + elyzza / 100 * neya[2].immref);
    neya[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        neya[7].votr = neya[7].votr + +neya[shatara[gotham]].votr;
      }
    }
    ;
    neya[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        neya[7].entreq = neya[7].entreq + +neya[pashion[gotham]].entreq;
      }
    }
    ;
    neya[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        neya[7].envreg = neya[7].envreg + +neya[seph[gotham]].envreg;
      }
    }
    ;
    neya[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        neya[7].womrig = neya[7].womrig + +neya[kaylia[gotham]].womrig;
      }
    }
    ;
    neya[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        neya[7].centfun = neya[7].centfun + +neya[antown[gotham]].centfun;
      }
    }
    ;
    neya[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        neya[7].abort = neya[7].abort + +neya[crissandra[gotham]].abort;
      }
    }
    ;
    neya[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        neya[7].fabort = neya[7].fabort + +neya[nellean[gotham]].fabort;
      }
    }
    ;
    var claristine = hedrick + neya[kohlten].sov + neya[tango].auto + neya[mayeli].govg + neya[cheetara].govc + neya[mikenzy].syse + neya[jeyline].sysl + neya[yulia].sysj + neya[creosha].rel + neya[francess].for + neya[maksymilian].cons + neya[marchia].righ + neya[daeqwon].minw + neya[ludy].minw2 + neya[robertta].pensreg + neya[wandalee].centow + neya[synai].murd + neya[nhut].rape + neya[cirilo].steal + neya[kaiyan].child + neya[rasheeta].defa + neya[alazaya].incit + neya[payzley].stprost + neya[absalom].broth + neya[mihajlo].esco + neya[ortrude].hand + neya[khaira].shot + neya[tyrik].rifle + neya[yobani].casin + neya[tishonna].oncasin + neya[cyrelle].sports + neya[annorah].homogen + neya[absalat].homoad + neya[ambrasia].transgen + neya[leomar].transad + neya[daisye].tobus + neya[garry].tobsel + neya[cleta].alcus + neya[tanysha].alcsel + neya[zuriya].canus + neya[symari].cansel + neya[sahmiyah].psyus + neya[feliciana].psysel + neya[jerren].stius + neya[jaquayla].stisel + neya[egypt].opius + neya[chrisa].opisel + neya[anjanie].euth + neya[tanisha].obsc + neya[zenorah].warc + neya[esven].corf + neya[cadem].blasph + neya[rodeny].treas + neya[athenamarie].embe + neya[koichi].misce + neya[trafton].disse + bradrick / 100 * neya[2].mifu + gracyn / 200 * neya[2].inher + charmisa / 200 * neya[2].inher + octavian / 100 * neya[2].reserv + katrice / 100 * neya[2].pover + faylyn / 100 * neya[2].unemp + oberia / 100 * neya[2].pens + juliocesar / 100 * neya[2].mininc + sincear / 100 * neya[2].basinc + chaylynn / 100 * neya[2].wast + dwania / 100 * neya[2].pubpa + arlease / 100 * neya[2].conser + fawzi / 100 * neya[2].solar + jahkor / 100 * neya[2].nucl + alicemae / 100 * neya[2].rnd + neya[7].votr + neya[7].entreq + neya[7].envreg + neya[7].womrig + neya[7].centfun + neya[7].abort + neya[7].fabort;
    var oplis = 4;
    var sybel = 0;
    if (andalyn == 2.5) {
      var oplis = 2.5;
    } else {
      if (andalyn == 0) {
        var sybel = virginnia[0].imman;
      }
    }
    ;
    var jandy = sybel + andalyn / oplis * virginnia[2].imman * (beatha / 100 * virginnia[2].immst + mija / 100 * virginnia[2].immwo + edman / 100 * virginnia[2].immas + elyzza / 100 * virginnia[2].immref);
    virginnia[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        virginnia[7].votr = virginnia[7].votr + +virginnia[shatara[gotham]].votr;
      }
    }
    ;
    virginnia[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        virginnia[7].entreq = virginnia[7].entreq + +virginnia[pashion[gotham]].entreq;
      }
    }
    ;
    virginnia[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        virginnia[7].envreg = virginnia[7].envreg + +virginnia[seph[gotham]].envreg;
      }
    }
    ;
    virginnia[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        virginnia[7].womrig = virginnia[7].womrig + +virginnia[kaylia[gotham]].womrig;
      }
    }
    ;
    virginnia[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        virginnia[7].centfun = virginnia[7].centfun + +virginnia[antown[gotham]].centfun;
      }
    }
    ;
    virginnia[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        virginnia[7].abort = virginnia[7].abort + +virginnia[crissandra[gotham]].abort;
      }
    }
    ;
    virginnia[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        virginnia[7].fabort = virginnia[7].fabort + +virginnia[nellean[gotham]].fabort;
      }
    }
    ;
    var sherlean = jandy + virginnia[kohlten].sov + virginnia[tango].auto + virginnia[mayeli].govg + virginnia[cheetara].govc + virginnia[mikenzy].syse + virginnia[jeyline].sysl + virginnia[yulia].sysj + virginnia[creosha].rel + virginnia[francess].for + virginnia[maksymilian].cons + virginnia[marchia].righ + virginnia[daeqwon].minw + virginnia[ludy].minw2 + virginnia[robertta].pensreg + virginnia[wandalee].centow + virginnia[synai].murd + virginnia[nhut].rape + virginnia[cirilo].steal + virginnia[kaiyan].child + virginnia[rasheeta].defa + virginnia[alazaya].incit + virginnia[payzley].stprost + virginnia[absalom].broth + virginnia[mihajlo].esco + virginnia[ortrude].hand + virginnia[khaira].shot + virginnia[tyrik].rifle + virginnia[yobani].casin + virginnia[tishonna].oncasin + virginnia[cyrelle].sports + virginnia[annorah].homogen + virginnia[absalat].homoad + virginnia[ambrasia].transgen + virginnia[leomar].transad + virginnia[daisye].tobus + virginnia[garry].tobsel + virginnia[cleta].alcus + virginnia[tanysha].alcsel + virginnia[zuriya].canus + virginnia[symari].cansel + virginnia[sahmiyah].psyus + virginnia[feliciana].psysel + virginnia[jerren].stius + virginnia[jaquayla].stisel + virginnia[egypt].opius + virginnia[chrisa].opisel + virginnia[anjanie].euth + virginnia[tanisha].obsc + virginnia[zenorah].warc + virginnia[esven].corf + virginnia[cadem].blasph + virginnia[rodeny].treas + virginnia[athenamarie].embe + virginnia[koichi].misce + virginnia[trafton].disse + bradrick / 100 * virginnia[2].mifu + gracyn / 200 * virginnia[2].inher + charmisa / 200 * virginnia[2].inher + octavian / 100 * virginnia[2].reserv + katrice / 100 * virginnia[2].pover + faylyn / 100 * virginnia[2].unemp + oberia / 100 * virginnia[2].pens + juliocesar / 100 * virginnia[2].mininc + sincear / 100 * virginnia[2].basinc + chaylynn / 100 * virginnia[2].wast + dwania / 100 * virginnia[2].pubpa + arlease / 100 * virginnia[2].conser + fawzi / 100 * virginnia[2].solar + jahkor / 100 * virginnia[2].nucl + alicemae / 100 * virginnia[2].rnd + virginnia[7].votr + virginnia[7].entreq + virginnia[7].envreg + virginnia[7].womrig + virginnia[7].centfun + virginnia[7].abort + virginnia[7].fabort;
    var benard = 4;
    var dezra = 0;
    if (andalyn == 2.5) {
      var benard = 2.5;
    } else {
      if (andalyn == 0) {
        var dezra = jamhal[0].imman;
      }
    }
    ;
    var debony = dezra + andalyn / benard * jamhal[2].imman * (beatha / 100 * jamhal[2].immst + mija / 100 * jamhal[2].immwo + edman / 100 * jamhal[2].immas + elyzza / 100 * jamhal[2].immref);
    jamhal[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        jamhal[7].votr = jamhal[7].votr + +jamhal[shatara[gotham]].votr;
      }
    }
    ;
    jamhal[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        jamhal[7].entreq = jamhal[7].entreq + +jamhal[pashion[gotham]].entreq;
      }
    }
    ;
    jamhal[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        jamhal[7].envreg = jamhal[7].envreg + +jamhal[seph[gotham]].envreg;
      }
    }
    ;
    jamhal[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        jamhal[7].womrig = jamhal[7].womrig + +jamhal[kaylia[gotham]].womrig;
      }
    }
    ;
    jamhal[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        jamhal[7].centfun = jamhal[7].centfun + +jamhal[antown[gotham]].centfun;
      }
    }
    ;
    jamhal[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        jamhal[7].abort = jamhal[7].abort + +jamhal[crissandra[gotham]].abort;
      }
    }
    ;
    jamhal[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        jamhal[7].fabort = jamhal[7].fabort + +jamhal[nellean[gotham]].fabort;
      }
    }
    ;
    var shantrel = debony + jamhal[kohlten].sov + jamhal[tango].auto + jamhal[mayeli].govg + jamhal[cheetara].govc + jamhal[mikenzy].syse + jamhal[jeyline].sysl + jamhal[yulia].sysj + jamhal[creosha].rel + jamhal[francess].for + jamhal[maksymilian].cons + jamhal[marchia].righ + jamhal[daeqwon].minw + jamhal[ludy].minw2 + jamhal[robertta].pensreg + jamhal[wandalee].centow + jamhal[synai].murd + jamhal[nhut].rape + jamhal[cirilo].steal + jamhal[kaiyan].child + jamhal[rasheeta].defa + jamhal[alazaya].incit + jamhal[payzley].stprost + jamhal[absalom].broth + jamhal[mihajlo].esco + jamhal[ortrude].hand + jamhal[khaira].shot + jamhal[tyrik].rifle + jamhal[yobani].casin + jamhal[tishonna].oncasin + jamhal[cyrelle].sports + jamhal[annorah].homogen + jamhal[absalat].homoad + jamhal[ambrasia].transgen + jamhal[leomar].transad + jamhal[daisye].tobus + jamhal[garry].tobsel + jamhal[cleta].alcus + jamhal[tanysha].alcsel + jamhal[zuriya].canus + jamhal[symari].cansel + jamhal[sahmiyah].psyus + jamhal[feliciana].psysel + jamhal[jerren].stius + jamhal[jaquayla].stisel + jamhal[egypt].opius + jamhal[chrisa].opisel + jamhal[anjanie].euth + jamhal[tanisha].obsc + jamhal[zenorah].warc + jamhal[esven].corf + jamhal[cadem].blasph + jamhal[rodeny].treas + jamhal[athenamarie].embe + jamhal[koichi].misce + jamhal[trafton].disse + bradrick / 100 * jamhal[2].mifu + gracyn / 200 * jamhal[2].inher + charmisa / 200 * jamhal[2].inher + octavian / 100 * jamhal[2].reserv + katrice / 100 * jamhal[2].pover + faylyn / 100 * jamhal[2].unemp + oberia / 100 * jamhal[2].pens + juliocesar / 100 * jamhal[2].mininc + sincear / 100 * jamhal[2].basinc + chaylynn / 100 * jamhal[2].wast + dwania / 100 * jamhal[2].pubpa + arlease / 100 * jamhal[2].conser + fawzi / 100 * jamhal[2].solar + jahkor / 100 * jamhal[2].nucl + alicemae / 100 * jamhal[2].rnd + jamhal[7].votr + jamhal[7].entreq + jamhal[7].envreg + jamhal[7].womrig + jamhal[7].centfun + jamhal[7].abort + jamhal[7].fabort;
    var mernie = 4;
    var desia = 0;
    if (andalyn == 2.5) {
      var mernie = 2.5;
    } else {
      if (andalyn == 0) {
        var desia = arling[0].imman;
      }
    }
    ;
    var vickki = desia + andalyn / mernie * arling[2].imman * (beatha / 100 * arling[2].immst + mija / 100 * arling[2].immwo + edman / 100 * arling[2].immas + elyzza / 100 * arling[2].immref);
    arling[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        arling[7].votr = arling[7].votr + +arling[shatara[gotham]].votr;
      }
    }
    ;
    arling[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        arling[7].entreq = arling[7].entreq + +arling[pashion[gotham]].entreq;
      }
    }
    ;
    arling[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        arling[7].envreg = arling[7].envreg + +arling[seph[gotham]].envreg;
      }
    }
    ;
    arling[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        arling[7].womrig = arling[7].womrig + +arling[kaylia[gotham]].womrig;
      }
    }
    ;
    arling[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        arling[7].centfun = arling[7].centfun + +arling[antown[gotham]].centfun;
      }
    }
    ;
    arling[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        arling[7].abort = arling[7].abort + +arling[crissandra[gotham]].abort;
      }
    }
    ;
    arling[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        arling[7].fabort = arling[7].fabort + +arling[nellean[gotham]].fabort;
      }
    }
    ;
    var roshena = vickki + arling[kohlten].sov + arling[tango].auto + arling[mayeli].govg + arling[cheetara].govc + arling[mikenzy].syse + arling[jeyline].sysl + arling[yulia].sysj + arling[creosha].rel + arling[francess].for + arling[maksymilian].cons + arling[marchia].righ + arling[daeqwon].minw + arling[ludy].minw2 + arling[robertta].pensreg + arling[wandalee].centow + arling[synai].murd + arling[nhut].rape + arling[cirilo].steal + arling[kaiyan].child + arling[rasheeta].defa + arling[alazaya].incit + arling[payzley].stprost + arling[absalom].broth + arling[mihajlo].esco + arling[ortrude].hand + arling[khaira].shot + arling[tyrik].rifle + arling[yobani].casin + arling[tishonna].oncasin + arling[cyrelle].sports + arling[annorah].homogen + arling[absalat].homoad + arling[ambrasia].transgen + arling[leomar].transad + arling[daisye].tobus + arling[garry].tobsel + arling[cleta].alcus + arling[tanysha].alcsel + arling[zuriya].canus + arling[symari].cansel + arling[sahmiyah].psyus + arling[feliciana].psysel + arling[jerren].stius + arling[jaquayla].stisel + arling[egypt].opius + arling[chrisa].opisel + arling[anjanie].euth + arling[tanisha].obsc + arling[zenorah].warc + arling[esven].corf + arling[cadem].blasph + arling[rodeny].treas + arling[athenamarie].embe + arling[koichi].misce + arling[trafton].disse + bradrick / 100 * arling[2].mifu + gracyn / 200 * arling[2].inher + charmisa / 200 * arling[2].inher + octavian / 100 * arling[2].reserv + katrice / 100 * arling[2].pover + faylyn / 100 * arling[2].unemp + oberia / 100 * arling[2].pens + juliocesar / 100 * arling[2].mininc + sincear / 100 * arling[2].basinc + chaylynn / 100 * arling[2].wast + dwania / 100 * arling[2].pubpa + arlease / 100 * arling[2].conser + fawzi / 100 * arling[2].solar + jahkor / 100 * arling[2].nucl + alicemae / 100 * arling[2].rnd + arling[7].votr + arling[7].entreq + arling[7].envreg + arling[7].womrig + arling[7].centfun + arling[7].abort + arling[7].fabort;
    var ronicka = 4;
    var brallan = 0;
    if (andalyn == 2.5) {
      var ronicka = 2.5;
    } else {
      if (andalyn == 0) {
        var brallan = jeyda[0].imman;
      }
    }
    ;
    var alana = brallan + andalyn / ronicka * jeyda[2].imman * (beatha / 100 * jeyda[2].immst + mija / 100 * jeyda[2].immwo + edman / 100 * jeyda[2].immas + elyzza / 100 * jeyda[2].immref);
    jeyda[7].votr = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (shatara[gotham]) {
        jeyda[7].votr = jeyda[7].votr + +jeyda[shatara[gotham]].votr;
      }
    }
    ;
    jeyda[7].entreq = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (pashion[gotham]) {
        jeyda[7].entreq = jeyda[7].entreq + +jeyda[pashion[gotham]].entreq;
      }
    }
    ;
    jeyda[7].envreg = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (seph[gotham]) {
        jeyda[7].envreg = jeyda[7].envreg + +jeyda[seph[gotham]].envreg;
      }
    }
    ;
    jeyda[7].womrig = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham]) {
        jeyda[7].womrig = jeyda[7].womrig + +jeyda[kaylia[gotham]].womrig;
      }
    }
    ;
    jeyda[7].centfun = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (antown[gotham]) {
        jeyda[7].centfun = jeyda[7].centfun + +jeyda[antown[gotham]].centfun;
      }
    }
    ;
    jeyda[7].abort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (crissandra[gotham]) {
        jeyda[7].abort = jeyda[7].abort + +jeyda[crissandra[gotham]].abort;
      }
    }
    ;
    jeyda[7].fabort = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (nellean[gotham]) {
        jeyda[7].fabort = jeyda[7].fabort + +jeyda[nellean[gotham]].fabort;
      }
    }
    ;
    var ehsan = alana + jeyda[kohlten].sov + jeyda[tango].auto + jeyda[mayeli].govg + jeyda[cheetara].govc + jeyda[mikenzy].syse + jeyda[jeyline].sysl + jeyda[yulia].sysj + jeyda[creosha].rel + jeyda[francess].for + jeyda[maksymilian].cons + jeyda[marchia].righ + jeyda[daeqwon].minw + jeyda[ludy].minw2 + jeyda[robertta].pensreg + jeyda[wandalee].centow + jeyda[synai].murd + jeyda[nhut].rape + jeyda[cirilo].steal + jeyda[kaiyan].child + jeyda[rasheeta].defa + jeyda[alazaya].incit + jeyda[payzley].stprost + jeyda[absalom].broth + jeyda[mihajlo].esco + jeyda[ortrude].hand + jeyda[khaira].shot + jeyda[tyrik].rifle + jeyda[yobani].casin + jeyda[tishonna].oncasin + jeyda[cyrelle].sports + jeyda[annorah].homogen + jeyda[absalat].homoad + jeyda[ambrasia].transgen + jeyda[leomar].transad + jeyda[daisye].tobus + jeyda[garry].tobsel + jeyda[cleta].alcus + jeyda[tanysha].alcsel + jeyda[zuriya].canus + jeyda[symari].cansel + jeyda[sahmiyah].psyus + jeyda[feliciana].psysel + jeyda[jerren].stius + jeyda[jaquayla].stisel + jeyda[egypt].opius + jeyda[chrisa].opisel + jeyda[anjanie].euth + jeyda[tanisha].obsc + jeyda[zenorah].warc + jeyda[esven].corf + jeyda[cadem].blasph + jeyda[rodeny].treas + jeyda[athenamarie].embe + jeyda[koichi].misce + jeyda[trafton].disse + bradrick / 100 * jeyda[2].mifu + gracyn / 200 * jeyda[2].inher + charmisa / 200 * jeyda[2].inher + octavian / 100 * jeyda[2].reserv + katrice / 100 * jeyda[2].pover + faylyn / 100 * jeyda[2].unemp + oberia / 100 * jeyda[2].pens + juliocesar / 100 * jeyda[2].mininc + sincear / 100 * jeyda[2].basinc + chaylynn / 100 * jeyda[2].wast + dwania / 100 * jeyda[2].pubpa + arlease / 100 * jeyda[2].conser + fawzi / 100 * jeyda[2].solar + jahkor / 100 * jeyda[2].nucl + alicemae / 100 * jeyda[2].rnd + jeyda[7].votr + jeyda[7].entreq + jeyda[7].envreg + jeyda[7].womrig + jeyda[7].centfun + jeyda[7].abort + jeyda[7].fabort;
    var vice = cheo * bradrick / 100;
    var myleigh = cheo * alicemae / 100;
    var fancie = cheo * sincear / 100;
    var vice = Math.easeIn(vice, 0, cheo, 1.8854);
    var myleigh = Math.easeIn(myleigh, 0, cheo, 1.75);
    var fancie = Math.easeIn(fancie, 0, cheo, 1.75);
    var monterey = 0;
    var erieonna = skylaar * cheo / 100 + lyjah * cheo / 100 + ailena * cheo / 100 + can * cheo / 100 + jakhiya * cheo / 100 + cythina * cheo / 100 + justyce * cheo / 100 + latronya * cheo / 100 + fredrik * cheo / 100 + darletta * cheo / 100;
    var sanel = skylaar * cheo / 100 + lyjah * cheo / 100 + ailena * cheo / 100 + can * cheo / 100 + jakhiya * cheo / 100 + cythina * cheo / 100 + justyce * cheo / 100 + latronya * cheo / 100 + darletta * cheo / 100;
    var izaiyah = roshena * erieonna * 0.015 / 36.3;
    var royalte = ehsan * erieonna * 0.015 / 94.7;
    if (izaiyah < 0) {
      var izaiyah = 0;
    }
    ;
    if (royalte < 0) {
      var royalte = 0;
    }
    ;
    var lilo = erieonna * 0.0025 * chaylynn / 100 + erieonna * 0.0005 * dwania / 100 + erieonna * 0.015 * arlease / 100 + erieonna * 0.005 * fawzi / 100 + erieonna * 0.005 * jahkor / 100 + erieonna * 0.02 * katrice / 100 + erieonna * 0.08 * faylyn / 100 + erieonna * 0.125 * oberia / 100 + erieonna * 0.08 * juliocesar / 100 + fancie + vice + myleigh + royalte;
    var monterey = erieonna + lilo;
    mucad.data.datasets[0].gdpz = monterey;
    asbel.data.datasets[0].gdpz = monterey;
    $(".gdpnum").html("GDP: $" + monterey.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln");
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      daleisa[gotham].sectgdp = daleisa[gotham].sectgdpprc * cheo / 100;
    }
    ;
    daleisa[10].sectgdp = lilo;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      if (daleisa[gotham].prcx < 0) {
        daleisa[gotham].owfun1 = daleisa[gotham].ownz * (Math.abs(daleisa[gotham].prcx) / 100);
        daleisa[gotham].owfun2 = daleisa[gotham].ownz - daleisa[gotham].ownz * (Math.abs(daleisa[gotham].prcx) / 100);
      } else {
        daleisa[gotham].owfun1 = 0;
        daleisa[gotham].owfun2 = daleisa[gotham].ownz;
      }
      ;
      daleisa[gotham].owfun4 = 100 - daleisa[gotham].ownz - daleisa[gotham].funz * (100 - daleisa[gotham].ownz) / 100;
      daleisa[gotham].owfun3 = daleisa[gotham].funz * (100 - daleisa[gotham].ownz) / 100;
    }
    ;
    if (amirra < 0) {
      daleisa[9].owfun1 = wesleigh * (Math.abs(amirra) / 100);
      daleisa[9].owfun2 = wesleigh - wesleigh * (Math.abs(amirra) / 100);
    } else {
      daleisa[9].owfun1 = 0;
      daleisa[9].owfun2 = wesleigh;
    }
    ;
    daleisa[9].owfun4 = 100 - wesleigh - kemeshia * (100 - wesleigh) / 100;
    daleisa[9].owfun3 = kemeshia * (100 - wesleigh) / 100;
    var julianni = 0;
    var amorion = 0;
    var brittnee = 0;
    var anaisabella = 0;
    for (gotham = 0; gotham < daleisa.length - 1; gotham++) {
      var julianni = julianni + daleisa[gotham].owfun1 * daleisa[gotham].sectgdp / erieonna;
      var amorion = amorion + daleisa[gotham].owfun2 * daleisa[gotham].sectgdp / erieonna;
      var brittnee = brittnee + daleisa[gotham].owfun3 * daleisa[gotham].sectgdp / erieonna;
      var anaisabella = anaisabella + daleisa[gotham].owfun4 * daleisa[gotham].sectgdp / erieonna;
    }
    ;
    var broderik = 0;
    var olexus = 0;
    var jerome = 0;
    var stanna = 0;
    for (gotham = 0; gotham < daleisa.length - 2; gotham++) {
      var broderik = broderik + daleisa[gotham].owfun1 * daleisa[gotham].sectgdp / sanel;
      var olexus = olexus + daleisa[gotham].owfun2 * daleisa[gotham].sectgdp / sanel;
      var jerome = jerome + daleisa[gotham].owfun3 * daleisa[gotham].sectgdp / sanel;
      var stanna = stanna + daleisa[gotham].owfun4 * daleisa[gotham].sectgdp / sanel;
    }
    ;
    var tishae = 0;
    var alaan = 0;
    var rushabh = 0;
    var jayke = 0;
    var clemie = 0;
    var paulann = 0;
    var bostin = 0;
    var bentli = 0;
    var jaxson = 0;
    var anooj = 0;
    var phillipp = 0;
    var araylia = 0;
    var jouree = 0;
    var anooj = 0;
    var maitri = 0;
    var brittaney = 0;
    var aeryanna = 0;
    var inis = rushabh + tishae + bostin;
    var inis = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      var inis = inis + (daleisa[gotham].labco + daleisa[gotham].matco + daleisa[gotham].locpro + daleisa[gotham].expro) * daleisa[gotham].sectgdp * daleisa[gotham].ownz / 100 * ((daleisa[gotham].prcx + 100) / 100);
    }
    ;
    var engels = (daleisa[0].labco + daleisa[0].matco) * daleisa[0].sectgdp * (daleisa[0].owfun1 + daleisa[0].owfun3) / 100 + (daleisa[0].labco * ((daleisa[0].wagx + 100) / 100) + daleisa[0].matco) * daleisa[0].sectgdp * daleisa[0].owfun1 / 100;
    var calel = (daleisa[3].labco + daleisa[3].matco) * daleisa[3].sectgdp * (daleisa[3].owfun1 + daleisa[3].owfun3) / 100 + (daleisa[3].labco * ((daleisa[3].wagx + 100) / 100) + daleisa[3].matco) * daleisa[3].sectgdp * daleisa[3].owfun1 / 100;
    var aleyza = 0;
    var aleyza = aleyza + (daleisa[0].labco * ((daleisa[0].wagx + 100) / 100) + daleisa[0].matco) * daleisa[0].sectgdp * daleisa[0].owfun2 / 100;
    var emmerich = 0;
    var emmerich = emmerich + (daleisa[3].labco * ((daleisa[3].wagx + 100) / 100) + daleisa[3].matco) * daleisa[3].sectgdp * daleisa[3].owfun2 / 100;
    var calhoun = 0;
    for (gotham = 1; gotham < daleisa.length - 2; gotham++) {
      if (gotham === 3) {
        continue;
      }
      ;
      var calhoun = calhoun + (daleisa[gotham].labco * ((daleisa[gotham].wagx + 100) / 100) + daleisa[gotham].matco) * daleisa[gotham].sectgdp * daleisa[gotham].ownz / 100;
    }
    ;
    var velvet = 0;
    for (gotham = 1; gotham < daleisa.length - 2; gotham++) {
      if (gotham === 3) {
        continue;
      }
      ;
      var velvet = velvet + (daleisa[gotham].labco + daleisa[gotham].matco) * daleisa[gotham].sectgdp * daleisa[gotham].owfun3 / 100;
    }
    ;
    var catelin = calhoun + velvet + aleyza + emmerich;
    var apolonio = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      var rakya = (daleisa[gotham].locpro + daleisa[gotham].expro) * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 * (daleisa[gotham].consz * 0.9 / 100);
      var jermesha = (daleisa[gotham].locpro + daleisa[gotham].expro) * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100;
      daleisa[gotham].cortx = (jermesha - rakya) * (daleisa[gotham].corz / 200) + (jermesha - rakya) * (daleisa[gotham].corz2 / 200);
      var bentli = bentli + daleisa[gotham].cortx;
    }
    ;
    var jaxson = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      var jaxson = jaxson + (daleisa[gotham].labco * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 - daleisa[gotham].labco * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 * (daleisa[gotham].consz * 0.9 / 100)) * (daleisa[gotham].incz / 200) + (daleisa[gotham].labco * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 - daleisa[gotham].labco * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 * (daleisa[gotham].consz * 0.9 / 100)) * (daleisa[gotham].incz2 / 200);
    }
    ;
    var paulann = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      daleisa[gotham].constx = daleisa[gotham].inctx * (daleisa[gotham].consz / 100);
    }
    ;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      var paulann = paulann + (daleisa[gotham].labco + daleisa[gotham].locpro + daleisa[gotham].expro) * daleisa[gotham].sectgdp * (daleisa[gotham].owfun3 + daleisa[gotham].owfun4) / 100 * (daleisa[gotham].consz * 0.9 / 100);
    }
    ;
    var anooj = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      daleisa[gotham].exptx = (daleisa[gotham].expro * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 - (daleisa[gotham].expro * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 * (daleisa[gotham].corz / 100) / 2 + daleisa[gotham].expro * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 * (daleisa[gotham].corz2 / 100) / 2)) * (daleisa[gotham].expz / 150);
    }
    ;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      var anooj = anooj + daleisa[gotham].exptx;
    }
    ;
    var phillipp = 0;
    for (gotham = 1; gotham < daleisa.length; gotham++) {
      var phillipp = phillipp + daleisa[gotham].matco * 0.25 * daleisa[gotham].impz / 150 * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100;
    }
    ;
    var araylia = 0;
    for (gotham = 1; gotham < daleisa.length; gotham++) {
      var araylia = araylia + daleisa[gotham].matco * 0.25 * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100;
    }
    ;
    var jouree = phillipp * 100 / araylia * (brittnee + anaisabella) / 100;
    for (gotham = 0; gotham < daleisa.length - 2; gotham++) {
      var mylinh = (daleisa[gotham].locpro + daleisa[gotham].expro) * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 * (daleisa[gotham].consz * 0.9 / 100);
      var malila = (daleisa[gotham].locpro + daleisa[gotham].expro) * daleisa[gotham].sectgdp * (daleisa[gotham].owfun3 + daleisa[gotham].owfun4) / 100;
      var apolonio = apolonio + malila - mylinh;
    }
    ;
    if (apolonio != 0) {
      var eliene = Math.round(bentli * (jerome + stanna) * 1.5 / apolonio);
    } else {
      var eliene = 0;
    }
    ;
    var lavayah = 0;
    for (gotham = 0; gotham < daleisa.length - 2; gotham++) {
      var lavayah = lavayah + (daleisa[gotham].labco * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 - daleisa[gotham].labco * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 * (daleisa[gotham].consz * 0.9 / 100)) * 0.5 + (daleisa[gotham].labco * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 - daleisa[gotham].labco * daleisa[gotham].sectgdp * daleisa[gotham].owfun4 / 100 * (daleisa[gotham].consz * 0.9 / 100)) * 0.5;
    }
    ;
    if (lavayah != 0) {
      var leyra = Math.round(jaxson * (jerome + stanna) / lavayah);
    } else {
      var leyra = 0;
    }
    ;
    var krisztina = 0;
    for (gotham = 0; gotham < daleisa.length - 2; gotham++) {
      var krisztina = krisztina + (daleisa[gotham].labco + daleisa[gotham].locpro + daleisa[gotham].expro) * daleisa[gotham].sectgdp * (daleisa[gotham].owfun3 + daleisa[gotham].owfun4) / 100 * 0.9;
    }
    ;
    if (krisztina != 0) {
      var kadeija = Math.round(paulann * stanna / krisztina + paulann * jerome / krisztina);
    } else {
      var kadeija = 0;
    }
    ;
    var syon = 0;
    for (gotham = 0; gotham < daleisa.length - 2; gotham++) {
      var syon = syon + (daleisa[gotham].expro * daleisa[gotham].sectgdp * (daleisa[gotham].owfun3 + daleisa[gotham].owfun4) / 100 - (daleisa[gotham].expro * daleisa[gotham].sectgdp * (daleisa[gotham].owfun3 + daleisa[gotham].owfun4) / 100 * (daleisa[gotham].corz / 100) / 2 + daleisa[gotham].expro * daleisa[gotham].sectgdp * (daleisa[gotham].owfun3 + daleisa[gotham].owfun4) / 100 * (daleisa[gotham].corz2 / 100) / 2));
    }
    ;
    if (syon != 0) {
      var shernette = Math.round(anooj * stanna / syon);
    } else {
      var shernette = 0;
    }
    ;
    var angelos = 0;
    for (gotham = 0; gotham < daleisa.length - 2; gotham++) {
      var angelos = angelos + daleisa[gotham].matco * 0.25 * 150 / 150 * daleisa[gotham].sectgdp * (daleisa[gotham].owfun3 + daleisa[gotham].owfun4) / 100;
    }
    ;
    if (angelos != 0) {
      var kreelynn = Math.round(phillipp * (jerome + stanna) / angelos);
    } else {
      var kreelynn = 0;
    }
    ;
    var starkisha = 0;
    var zaya = 0;
    for (gotham = 0; gotham < daleisa.length - 2; gotham++) {
      var starkisha = starkisha + 100 * daleisa[gotham].sectgdp;
      var zaya = zaya + daleisa[gotham].funz * daleisa[gotham].sectgdp;
    }
    ;
    if (starkisha != 0) {
      var maysea = Math.round(zaya * (jerome + stanna) / starkisha);
    } else {
      var maysea = 0;
    }
    ;
    var myelle = Math.round((eliene + (100 - maysea) * leyra / 100 + (100 - eliene) * shernette * 0.005 + (100 - maysea) * kreelynn * 0.005) * 0.65 / 3 + maysea * 0.65 + kadeija * 0.35).toLocaleString(5);
    var yaidel = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      var yaidel = yaidel + daleisa[gotham].sectgdp * daleisa[gotham].ownz / 100;
    }
    ;
    var lanadia = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      var lanadia = lanadia + daleisa[gotham].sectgdp * daleisa[gotham].ownz / 100 * (Math.abs(daleisa[gotham].prcx) / 100);
    }
    ;
    if (yaidel != 0) {
      var makii = lanadia * (julianni + amorion) / yaidel;
    } else {
      var makii = 0;
    }
    ;
    var lavion = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      if (daleisa[gotham].wagx < 0) {
        var naor = daleisa[gotham].wagx * 1.7;
      } else {
        var naor = daleisa[gotham].wagx;
      }
      ;
      var lavion = lavion + daleisa[gotham].sectgdp * daleisa[gotham].ownz / 100 * (Math.abs(naor) / 100);
    }
    ;
    if (yaidel != 0) {
      var arun = lavion * (julianni + amorion) / yaidel;
    } else {
      var arun = 0;
    }
    ;
    var bisola = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      if (daleisa[gotham].wagrx < 0) {
        var connal = daleisa[gotham].wagrx * 4;
      } else {
        var connal = daleisa[gotham].wagrx;
      }
      ;
      var bisola = bisola + daleisa[gotham].sectgdp * daleisa[gotham].ownz * ((daleisa[gotham].wagx + 100) / 200) / 100 * (Math.abs(connal) / 400);
    }
    ;
    if (yaidel != 0) {
      var eduan = bisola * (julianni + amorion) / yaidel;
    } else {
      var eduan = 0;
    }
    ;
    var bethie = Math.round((makii * 1.3 + arun + eduan * 0.7) * 0.65 / 3 + (julianni + amorion) * 0.35).toLocaleString(2);
    var roohi = (gracyn / 100 * monterey * 1.3 + charmisa / 100 * monterey * 3.7) * 0.015;
    var jarethzy = (monterey * 1.3 + monterey * 3.7) * 0.015;
    var aaryah = roohi * 100 / jarethzy;
    var lanz = nitosha * monterey / 407.9;
    var ilie = ignazio * monterey / 800;
    var wenola = makaylen * daleisa[9].sectgdp / 200;
    var thorne = tilly * daleisa[9].sectgdp / 200;
    var tangela = (amirra + 100) * daleisa[9].sectgdp / 200;
    var iovanna = (blayne + 100) * daleisa[9].sectgdp / 200;
    var selestino = (wenola + thorne + lanz + ilie) * (1 - wesleigh / 100);
    var tiela = (tangela + iovanna) * (wesleigh / 100);
    var tynlie = selestino + tiela;
    var elexcia = kemeshia * daleisa[9].sectgdp / 100;
    var cheyeene = elexcia * (1 - wesleigh / 100);
    var rollins = (100 * monterey / 400 + 100 * monterey / 900 + 100 * daleisa[9].sectgdp / 200 + 100 * daleisa[9].sectgdp / 200) * (1 - wesleigh / 100);
    var vukasin = Math.abs(amirra) * daleisa[9].sectgdp / 100 + Math.abs(blayne) * daleisa[9].sectgdp / 100;
    var bjarne = 200 * daleisa[9].sectgdp / 200 + 200 * daleisa[9].sectgdp / 200;
    var smera = vukasin * 100 * (wesleigh / 100) / bjarne;
    if (wesleigh == 100) {
      var petronilla = 0;
    } else {
      var petronilla = selestino * 100 * (1 - wesleigh / 100) / rollins;
    }
    ;
    var irelan = fredrik * cheo / 100 / erieonna;
    var lyvia = (smera + petronilla) * irelan;
    var petronilo = ((parseInt(myelle) + parseInt(bethie)) * (1 - irelan) + lyvia) * 0.7 + aaryah * 0.08 + sherlean * 0.22;
    var petronilo = petronilo.toLocaleString(undefined, {maximumFractionDigits: 1});
    var hiya = 0;
    var terriauna = 0;
    var saderia = 0;
    var ridley = 0;
    for (gotham = 0; gotham < daleisa.length - 2; gotham++) {
      var ridley = ridley + (daleisa[gotham].prcx + 100) / 2 * daleisa[gotham].sectgdp / sanel;
      var hiya = hiya + (daleisa[gotham].wagrx + 99) / 499 * daleisa[gotham].sectgdp / sanel;
      var terriauna = terriauna + (daleisa[gotham].wagx + 100) / 200 * daleisa[gotham].sectgdp / sanel;
    }
    ;
    var saderia = hiya * terriauna * 100;
    var shandera = saderia / 2 + ridley / 2;
    var shandera = sanel / erieonna * shandera;
    var alaysiah = (amirra + 100) / 4 + (blayne + 100) / 4;
    var alaysiah = alaysiah * (1 - sanel / erieonna);
    var mariapaz = (shandera + alaysiah) * (julianni + amorion) / 100;
    var aeryanna = 0;
    for (gotham = 0; gotham < daleisa.length; gotham++) {
      var aeryanna = aeryanna + (daleisa[gotham].owfun1 * daleisa[gotham].sectgdp + daleisa[gotham].owfun2 * daleisa[gotham].sectgdp);
    }
    ;
    if (kohlten == 3 && tanushree == 1) {
      var kunal = (aeryanna / monterey).toFixed(1);
    } else {
      var kunal = (aeryanna / monterey + lilo * 100 / monterey).toFixed(1);
    }
    ;
    if (isNaN(kunal)) {
      var kunal = 0;
    }
    ;
    var jamorion = (100 - kunal).toFixed(1);
    var joris = bentli + jaxson + paulann + phillipp + anooj + inis + roohi + tynlie + izaiyah;
    var tamotsu = monterey * 0.0025 * chaylynn / 100 + monterey * 0.0005 * dwania / 100 + monterey * 0.015 * arlease / 100 + monterey * 0.005 * fawzi / 100 + monterey * 0.005 * jahkor / 100;
    var kateisha = erieonna * 0.02 * katrice / 100 + erieonna * 0.08 * faylyn / 100 + erieonna * 0.125 * oberia / 100 + erieonna * 0.08 * juliocesar / 100 + fancie + calel;
    var keir = 0;
    if (marchia <= 1 && andalyn < 2.5) {
      var keir = andalyn * kateisha / 36;
    } else {
      if (marchia <= 1 && andalyn == 2.5) {
        var keir = andalyn * kateisha / 20;
      }
    }
    ;
    var kateisha = kateisha + keir;
    var iria = vice + kateisha + engels + myleigh + tamotsu + cheyeene + catelin + royalte;
    var geo = (joris - iria).toFixed(1);
    var neekon = (iria + alaan) * 100 / monterey;
    var fara = (iria + alaan - vice * 1.3) * 100 / monterey;
    var fara = Math.easeIn(fara, 0, 100, 0.765).toFixed(1);
    if (isNaN(fara)) {
      var fara = 0;
    }
    ;
    if (fara > 100) {
      var fara = 100;
    }
    ;
    if (fara < 0) {
      var fara = 0;
    }
    ;
    var leallen = (100 - fara).toFixed(1);
    var maitri = maitri * jamorion / 100 + parseInt(kunal);
    var brittaney = brittaney * jamorion / 100 + parseInt(kunal);
    if (kohlten == 0) {
      var maitri = 0;
      var brittaney = 0;
    }
    ;
    if (isNaN(maitri)) {
      var maitri = 100;
    }
    ;
    if (isNaN(brittaney)) {
      var brittaney = 100;
    }
    ;
    var janinne = claristine * 0.8 + brittaney * 0.15 + maitri * 0.05;
    if (tramane >= 100) {
      var tramane = 100;
    }
    ;
    if (tramane < 0) {
      var tramane = 0;
    }
    ;
    if (zafer >= 100) {
      var zafer = 100;
    }
    ;
    if (zafer < 0) {
      var zafer = 0;
    }
    ;
    if (leiyah >= 100) {
      var leiyah = 100;
    }
    ;
    if (leiyah < 0) {
      var leiyah = 0;
    }
    ;
    if (mehrdad >= 100) {
      var mehrdad = 100;
    }
    ;
    if (mehrdad < 0) {
      var mehrdad = 0;
    }
    ;
    if (janinne >= 100) {
      var janinne = 100;
    }
    ;
    if (janinne < 0) {
      var janinne = 0;
    }
    ;
    if (petronilo >= 100) {
      var petronilo = 100;
    }
    ;
    if (petronilo < 0) {
      var petronilo = 0;
    }
    ;
    if (neekon >= 100) {
      var neekon = 100;
    }
    ;
    if (neekon < 0) {
      var neekon = 0;
    }
    ;
    if (kunal >= 100) {
      var kunal = 100;
    }
    ;
    if (kunal < 0) {
      var kunal = 0;
    }
    ;
    var tramane = Math.easeIn(tramane, 0, 100, 0.437).toFixed(1);
    var hava = (100 - tramane).toFixed(1);
    var zafer = Math.easeIn(zafer, 0, 100, 1.123).toFixed(1);
    var aryon = (100 - zafer).toFixed(1);
    var leiyah = Math.easeIn(leiyah, 0, 100, 0.456).toFixed(1);
    var sekia = (100 - leiyah).toFixed(1);
    var mehrdad = Math.easeIn(mehrdad, 0, 100, 0.92).toFixed(1);
    var aydah = (100 - mehrdad).toFixed(1);
    var janinne = Math.easeIn(janinne, 0, 100, 1.015).toFixed(1);
    var joshuacaleb = (100 - janinne).toFixed(1);
    var petronilo = Math.easeIn(petronilo, 0, 100, 0.529).toFixed(1);
    var ashantae = petronilo;
    var kaylisha = (100 - ashantae).toFixed(1);
    var neekon = Math.easeIn(neekon, 0, 104, 0.757).toFixed(1);
    var ciyana = (100 - neekon).toFixed(1);
    var kunal = Math.easeIn(kunal, 0, 104.5, 0.773).toFixed(1);
    var jamorion = (100 - kunal).toFixed(1);
    var sunnye = mohit[tango].struc1 + " " + mohit[cheetara].struc2 + " " + mohit[kohlten].struc3;
    if (kohlten == 3 && cheetara == 0) {
      var sunnye = mohit[tango].struc4;
    }
    ;
    if (kohlten == 3 && cheetara != 0) {
      var sunnye = mohit[tango].struc1 + " " + mohit[cheetara].struc5;
    }
    ;
    $(".structz").html(sunnye);
    var aviva = "";
    var nalen = "-";
    if (mayeli == 0) {
      if (jeyline == 0) {
        var nalen = seleen[mikenzy].dirz;
      } else {
        if (jeyline == 1) {
          var nalen = seleen[mikenzy].elez;
        } else {
          if (jeyline == 2) {
            var nalen = seleen[mikenzy].appz;
          } else {
            if (jeyline == 3) {
              var nalen = seleen[mikenzy].exez;
            }
          }
        }
      }
    } else {
      if (mayeli == 1) {
        if (jeyline == 0) {
          var nalen = hamaad[mikenzy].dirz;
        } else {
          if (jeyline == 1) {
            var nalen = hamaad[mikenzy].elez;
          } else {
            if (jeyline == 2) {
              var nalen = hamaad[mikenzy].appz;
            } else {
              if (jeyline == 3) {
                var nalen = hamaad[mikenzy].exez;
              }
            }
          }
        }
      }
    }
    ;
    if (yulia <= 1 || yulia == 2 && (mikenzy <= 1 || jeyline <= 1)) {
      var aviva = "Constitutional";
    }
    ;
    if (mikenzy == 0 && jeyline == 3 && yulia == 3) {
      var nalen = "Absolute Democracy";
    }
    ;
    if (mikenzy == 3 && jeyline == 3 && yulia == 3 && mayeli == 1) {
      var nalen = "Absolute Hereditary Monarchy";
    }
    ;
    if (mikenzy == 2 && jeyline == 3 && yulia == 3 && mayeli == 1) {
      var nalen = "Absolute Elective Monarchy";
    }
    ;
    $(".structz2").html(aviva + " " + nalen);
    var jesmin = kateisha * 100 / monterey;
    var kadeejah = "";
    var mikaeel = "";
    var camica = daleisa[5].sectgdp * 100 / monterey * (1 - daleisa[5].ownz / 100);
    var katiana = daleisa[7].sectgdp * 100 / monterey * (1 - daleisa[7].ownz / 100);
    var kealia = daleisa[9].sectgdp * 100 / monterey * (1 - daleisa[9].ownz / 100);
    var rance = (daleisa[5].impz - daleisa[5].expz) / 3 + 50;
    var desinae = (daleisa[7].impz - daleisa[7].expz) / 3 + 50;
    var mckenzlie = (daleisa[9].expz - daleisa[9].impz) / 3 + 50;
    var jazia = rance * camica / 100 + desinae * katiana / 100 + mckenzlie * kealia / 100;
    if (jouree >= 40 && kohlten != 0) {
      var kadeejah = "Protectionist";
    }
    ;
    if (jazia >= 28 && kohlten != 0) {
      var kadeejah = "Mercantilist";
    }
    ;
    if (antown[0] && antown[1] && antown[2] && wandalee == 0 && jazia >= 31 && kohlten != 0) {
      var kadeejah = "Neomercantilist";
    }
    ;
    if (julianni + amorion >= 68 && julianni >= 34) {
      var mikaeel = "Socialism";
    }
    ;
    if (bethie <= 50 && julianni + amorion >= 68) {
      var mikaeel = "Market Socialism";
    }
    ;
    if (amorion >= 68 && mariapaz >= 35) {
      var mikaeel = "State Capitalism";
    }
    ;
    if (jesmin >= 20 && amorion >= 68) {
      var mikaeel = "State Socialism";
    }
    ;
    if (brittnee + anaisabella >= 78) {
      var mikaeel = "Capitalism";
    }
    ;
    if (brittnee + anaisabella >= 68 && brittnee >= 34) {
      var mikaeel = "Subsidized Capitalism";
    }
    ;
    if (brittnee + anaisabella >= 78 && myelle >= 50) {
      var mikaeel = "Regulatory Capitalism";
    }
    ;
    if (brittnee + anaisabella >= 78 && myelle <= 10) {
      var mikaeel = "Free Market Capitalism";
    }
    ;
    if (jesmin >= 20 && anaisabella >= 68) {
      var mikaeel = "Welfare Capitalism";
    }
    ;
    if (anaisabella >= 85 && ashantae <= 13 && neekon < 20) {
      var mikaeel = "Laissez Faire Capitalism";
    }
    ;
    if (anaisabella >= 100 && ashantae <= 2.5 && neekon < 20) {
      var mikaeel = "Ultracapitalism";
    }
    ;
    if (julianni + amorion >= 33 && brittnee + anaisabella >= 33 && jesmin >= 20 && ashantae >= 38 && ashantae <= 68) {
      var mikaeel = "Social Market Economy";
    }
    ;
    if ((amorion >= 70 || julianni >= 50) && kohlten == 3 && mayeli == 0 && mikenzy <= 0 && jeyline <= 0 && cheetara == 1) {
      var mikaeel = "Mutualism";
    }
    ;
    if (mikaeel == "") {
      var mikaeel = "Mixed Economy";
    }
    ;
    if (kadeejah == "Protectionist" && mikaeel == "") {
      var kadeejah = "Protectionism";
    }
    ;
    if (kadeejah == "Mercantilist" && mikaeel == "") {
      var kadeejah = "Mercantilism";
    }
    ;
    if (kadeejah == "Neomercantilist" && mikaeel == "") {
      var kadeejah = "Neomercantilism";
    }
    ;
    $(".structz3").html(kadeejah + " " + mikaeel);
    var careena = "";
    var sarahbeth = "";
    var stevielynn = "";
    var mikaylyn = "";
    if (leiyah <= 38 && trafton == 0) {
      var careena = "Liberal";
    }
    ;
    if (leiyah <= 8 && trafton == 0) {
      var careena = "Libertarian";
    }
    ;
    if (trafton >= 1 || leiyah >= 67) {
      var careena = "Authoritarian";
    }
    ;
    var astoria = 0;
    var madelina = 0;
    for (gotham = 0; gotham < 10; gotham++) {
      if (kaylia[gotham] <= 3) {
        var astoria = astoria + 1;
      }
      ;
      if (mikenzy >= 2 && jeyline >= 2 && yulia >= 2) {
        var madelina = 1;
      }
    }
    ;
    if (astoria + madelina <= 2) {
      var sarahbeth = "Patriarchal";
    }
    ;
    if (mehrdad >= 58) {
      var stevielynn = "Traditionalist";
    }
    ;
    if (mehrdad >= 85) {
      var stevielynn = "Ultratraditionalist";
    }
    ;
    if (mehrdad <= 15) {
      var stevielynn = "Progressive";
    }
    ;
    if (janinne >= 58) {
      var mikaylyn = "Nativism";
    }
    ;
    if (janinne >= 71) {
      var mikaylyn = "Nationalism";
    }
    ;
    if (janinne >= 92) {
      var mikaylyn = "Ultranationalism";
    }
    ;
    if (claristine <= 34) {
      var mikaylyn = "Cosmopolitanism";
    }
    ;
    if (shantrel == 0 && andalyn >= 1.8) {
      var mikaylyn = "Multiculturalism";
    }
    ;
    if (janinne <= 3) {
      var mikaylyn = "Globalism";
    }
    ;
    if (careena == "Authoritarian" && sarahbeth == "" && stevielynn == "" && mikaylyn == "") {
      var careena = "Authoritarianism";
    }
    ;
    if (careena == "Liberal" && sarahbeth == "" && stevielynn == "" && mikaylyn == "") {
      var careena = "Liberalism";
    }
    ;
    if (careena == "Libertarian" && sarahbeth == "" && stevielynn == "" && mikaylyn == "") {
      var careena = "Libertarianism";
    }
    ;
    if (sarahbeth == "Patriarchal" && stevielynn == "" && mikaylyn == "") {
      var sarahbeth = "Patriarchy";
    }
    ;
    if (stevielynn == "Traditionalist" && mikaylyn == "") {
      var stevielynn = "Traditionalism";
    }
    ;
    if (stevielynn == "Ultratraditionalist" && mikaylyn == "") {
      var stevielynn = "Ultratraditionalism";
    }
    ;
    if (stevielynn == "Progressive" && mikaylyn == "") {
      var stevielynn = "Progressivism";
    }
    ;
    if (stevielynn == "Modernist" && mikaylyn == "") {
      var stevielynn = "Modernism";
    }
    ;
    if (careena != "" && sarahbeth != "" && stevielynn != "" && mikaylyn != "") {
      $(".structz4").css("font-size", "1.2rem");
    } else {
      $(".structz4").css("font-size", "1.35rem");
    }
    ;
    $(".structz4").html(careena + " " + sarahbeth + " " + stevielynn + " " + mikaylyn);
    if (careena == "" && sarahbeth == "" && stevielynn == "" && mikaylyn == "") {
      $(".structz4").html("-");
    }
    ;
    if (kohlten == 4) {
      $.each(trelynn.datasets, function (lindora, genetha) {
        genetha.pointRadius = 6;
        genetha.pointHoverRadius = 6;
      });
      $(".structz").html("Egoist Anarchism");
      $(".structz2").html("-");
      $(".structz3").html("-");
      $(".structz4").html("-");
    }
    ;
    var tinie = (vice - tamotsu) * 100 / iria;
    var jimma = 100 - (iria - vice) * 100 / iria;
    var torray = (kateisha + tamotsu - clemie) * 100 / monterey;
    var wyllys = myleigh * 100 / iria;
    var chonda = (100 - wyllys).toFixed(1);
    var rawa = (100 - torray).toFixed(1);
    var pinar = tinie + ciyana;
    if (pinar >= 100) {
      var pinar = 100;
    }
    ;
    if (isNaN) {
      if (isNaN(tinie)) {
        var tinie = 0;
      }
    }
    ;
    if (isNaN(chonda)) {
      var chonda = 100;
    }
    ;
    if (isNaN(wyllys)) {
      var wyllys = 0;
    }
    ;
    if (isNaN(rawa)) {
      var rawa = 100;
    }
    ;
    if (kohlten == 0) {
      var deasya = 1.05;
    } else {
      if (kohlten == 3) {
        var deasya = 0.25;
      } else {
        if (kohlten == 2) {
          var deasya = 0.85;
        } else {
          var deasya = 1;
        }
      }
    }
    ;
    if (tango == 0) {
      var nikitia = 1.1;
    } else {
      if (tango == 1) {
        var nikitia = 1.05;
      } else {
        if (tango == 3) {
          var nikitia = 0.85;
        } else {
          if (tango == 4) {
            var nikitia = 0.5;
          } else {
            var nikitia = 1;
          }
        }
      }
    }
    ;
    if (francess == 4) {
      var nanalee = 1.05;
    } else {
      var nanalee = 1;
    }
    ;
    var lluvia = (brittnee + anaisabella) * 0.2 + leallen * nanalee * 0.8;
    var pameal = zafer * 0.6 + lluvia * 0.4;
    var pameal = zafer * 0.6 + jamorion * 0.3 + mariapaz * 0.2 + tinie * 0.2 + (100 - petronilo) * 0.1;
    var anaysa = kunal * 0.5 + (100 - mariapaz) * 0.5 + myelle * 0.5;
    var tanav = 100 - mariapaz;
    var bernella = petronilo * 0.8 + jimma * 0.2;
    var jylian = tramane * nikitia * 0.6 + bernella * deasya * 0.4;
    var pameal = pameal.toFixed(1);
    var jylian = jylian.toFixed(1);
    if (pameal > 100) {
      var pameal = 100;
    }
    ;
    if (pameal < 0) {
      var pameal = 0;
    }
    ;
    if (jylian > 100) {
      var jylian = 100;
    }
    ;
    if (jylian < 0) {
      var jylian = 0;
    }
    ;
    var syrenity = (100 - pameal).toFixed(1);
    var senetria = (100 - jylian).toFixed(1);
    var lashawnna = (pameal * 2 - 100) * 0.732;
    var bartly = (jylian * 2 - 100) * 0.732;
    if (lashawnna > 73.2) {
      var lashawnna = 73.2;
    }
    ;
    if (bartly > 73.2) {
      var bartly = 73.2;
    }
    ;
    if (lashawnna < -73.2) {
      var lashawnna = -73.2;
    }
    ;
    if (bartly < -73.2) {
      var bartly = -73.2;
    }
    ;
    var kaylani = lashawnna;
    var rehansh = bartly;
    var canyla = 0;
    var nayya = 0;
    var ceola = 104;
    var agustus = 0;
    var jemely = 0;
    var carsan = 104;
    var lavone = ((agustus - carsan) * (kaylani - jemely) + (jemely - ceola) * (rehansh - carsan)) / ((agustus - carsan) * (canyla - jemely) + (jemely - ceola) * (nayya - carsan));
    var lex = ((carsan - nayya) * (kaylani - jemely) + (canyla - jemely) * (rehansh - carsan)) / ((agustus - carsan) * (canyla - jemely) + (jemely - ceola) * (nayya - carsan));
    var josha = 1 - lavone - lex;
    if (lavone >= 0 && lavone <= 1 && lex >= 0 && lex <= 1 && josha >= 0 && josha <= 1) {
      var lousie = 1;
    } else {
      var lousie = 0;
    }
    ;
    var novie = lashawnna;
    var akida = bartly;
    var juliya = 0;
    var adyline = 0;
    var payal = 104;
    var daney = 0;
    var rone = 0;
    var hasty = -104;
    var marsa = ((daney - hasty) * (novie - rone) + (rone - payal) * (akida - hasty)) / ((daney - hasty) * (juliya - rone) + (rone - payal) * (adyline - hasty));
    var addylynn = ((hasty - adyline) * (novie - rone) + (juliya - rone) * (akida - hasty)) / ((daney - hasty) * (juliya - rone) + (rone - payal) * (adyline - hasty));
    var lainy = 1 - marsa - addylynn;
    if (marsa >= 0 && marsa <= 1 && addylynn >= 0 && addylynn <= 1 && lainy >= 0 && lainy <= 1) {
      var trishanna = 1;
    } else {
      var trishanna = 0;
    }
    ;
    var koven = lashawnna;
    var cyree = bartly;
    var aqua = 0;
    var talique = 0;
    var denson = -104;
    var shauniqua = 0;
    var ingra = 0;
    var zafeer = -104;
    var ojay = ((shauniqua - zafeer) * (koven - ingra) + (ingra - denson) * (cyree - zafeer)) / ((shauniqua - zafeer) * (aqua - ingra) + (ingra - denson) * (talique - zafeer));
    var ladelle = ((zafeer - talique) * (koven - ingra) + (aqua - ingra) * (cyree - zafeer)) / ((shauniqua - zafeer) * (aqua - ingra) + (ingra - denson) * (talique - zafeer));
    var elondra = 1 - ojay - ladelle;
    if (ojay >= 0 && ojay <= 1 && ladelle >= 0 && ladelle <= 1 && elondra >= 0 && elondra <= 1) {
      var makali = 1;
    } else {
      var makali = 0;
    }
    ;
    var sedricka = lashawnna;
    var nasaiah = bartly;
    var abdussamad = 0;
    var kalina = 0;
    var zamirra = -104;
    var raziel = 0;
    var maebell = 0;
    var lotus = 104;
    var laytoya = ((raziel - lotus) * (sedricka - maebell) + (maebell - zamirra) * (nasaiah - lotus)) / ((raziel - lotus) * (abdussamad - maebell) + (maebell - zamirra) * (kalina - lotus));
    var valaria = ((lotus - kalina) * (sedricka - maebell) + (abdussamad - maebell) * (nasaiah - lotus)) / ((raziel - lotus) * (abdussamad - maebell) + (maebell - zamirra) * (kalina - lotus));
    var keilin = 1 - laytoya - valaria;
    if (laytoya >= 0 && laytoya <= 1 && valaria >= 0 && valaria <= 1 && keilin >= 0 && keilin <= 1) {
      var dannille = 1;
    } else {
      var dannille = 0;
    }
    ;
    var ryanne = 0;
    var rella = 104;
    var lyanno = 104;
    var marka = 0;
    var xena = lashawnna + 104;
    var santina = bartly + 104;
    var nykeba = lashawnna;
    var shomari = bartly;
    var kamouri = ((ryanne * marka - rella * lyanno) * (xena - nykeba) - (ryanne - lyanno) * (xena * shomari - santina * nykeba)) / ((ryanne - lyanno) * (santina - shomari) - (rella - marka) * (xena - nykeba));
    var lihi = ((ryanne * marka - rella * lyanno) * (rella - marka) - (rella - marka) * (xena * shomari - santina * nykeba)) / ((ryanne - lyanno) * (santina - shomari) - (rella - marka) * (xena - nykeba));
    var johnni = 0;
    var antrina = -104;
    var johnathan = 104;
    var yankarlo = 0;
    var tinsae = lashawnna + 104;
    var breyanna = bartly - 104;
    var jakelia = lashawnna;
    var aldwin = bartly;
    var cederick = ((johnni * yankarlo - antrina * johnathan) * (tinsae - jakelia) - (johnni - johnathan) * (tinsae * aldwin - breyanna * jakelia)) / ((johnni - johnathan) * (breyanna - aldwin) - (antrina - yankarlo) * (tinsae - jakelia));
    var waylen = ((johnni * yankarlo - antrina * johnathan) * (antrina - yankarlo) - (antrina - yankarlo) * (tinsae * aldwin - breyanna * jakelia)) / ((johnni - johnathan) * (breyanna - aldwin) - (antrina - yankarlo) * (tinsae - jakelia));
    var lynissa = -104;
    var decarri = 0;
    var jakeisha = 0;
    var perfect = -104;
    var jabraun = lashawnna + 104;
    var gilmore = bartly + 104;
    var timia = lashawnna;
    var tarijah = bartly;
    var floye = ((lynissa * perfect - decarri * jakeisha) * (jabraun - timia) - (lynissa - jakeisha) * (jabraun * tarijah - gilmore * timia)) / ((lynissa - jakeisha) * (gilmore - tarijah) - (decarri - perfect) * (jabraun - timia));
    var bienvenido = ((lynissa * perfect - decarri * jakeisha) * (decarri - perfect) - (decarri - perfect) * (jabraun * tarijah - gilmore * timia)) / ((lynissa - jakeisha) * (gilmore - tarijah) - (decarri - perfect) * (jabraun - timia));
    var ezel = -104;
    var chrisanthe = 0;
    var fedele = 0;
    var zareth = 104;
    var isia = lashawnna + 104;
    var heavenlyjoy = bartly - 104;
    var tequilla = lashawnna;
    var weyman = bartly;
    var alexisjade = ((ezel * zareth - chrisanthe * fedele) * (isia - tequilla) - (ezel - fedele) * (isia * weyman - heavenlyjoy * tequilla)) / ((ezel - fedele) * (heavenlyjoy - weyman) - (chrisanthe - zareth) * (isia - tequilla));
    var airyana = ((ezel * zareth - chrisanthe * fedele) * (chrisanthe - zareth) - (chrisanthe - zareth) * (isia * weyman - heavenlyjoy * tequilla)) / ((ezel - fedele) * (heavenlyjoy - weyman) - (chrisanthe - zareth) * (isia - tequilla));
    var lacrista = lashawnna;
    var mordechai = bartly;
    if (lashawnna > 5 && bartly > 5 && lousie == 0) {
      var lacrista = kamouri;
      var mordechai = lihi;
    }
    ;
    if (lashawnna > 5 && bartly < -5 && trishanna == 0) {
      var lacrista = cederick;
      var mordechai = waylen;
    }
    ;
    if (lashawnna < -5 && bartly < -5 && makali == 0) {
      var lacrista = floye;
      var mordechai = bienvenido;
    }
    ;
    if (lashawnna < -5 && bartly > 5 && dannille == 0) {
      var lacrista = alexisjade;
      var mordechai = airyana;
    }
    ;
    if (kohlten == 4) {
      var lacrista = 0;
    }
    ;
    if (kohlten == 4) {
      var mordechai = -83.5;
    }
    ;
    trelynn.datasets[0].data = [{x: lacrista, y: mordechai}, {x: 100, y: 100}, {x: -100, y: -100}, {x: -100, y: 100}, {x: 100, y: -100}];
    mucad.data.datasets[0].data[0] = bentli;
    mucad.data.datasets[0].data[1] = jaxson;
    mucad.data.datasets[0].data[2] = paulann;
    mucad.data.datasets[0].data[3] = phillipp;
    mucad.data.datasets[0].data[4] = anooj;
    mucad.data.datasets[0].data[5] = roohi;
    mucad.data.datasets[0].data[6] = tynlie;
    mucad.data.datasets[0].data[7] = inis;
    mucad.data.datasets[0].data[8] = izaiyah;
    asbel.data.datasets[0].data[0] = vice;
    asbel.data.datasets[0].data[1] = kateisha;
    asbel.data.datasets[0].data[2] = engels;
    asbel.data.datasets[0].data[3] = myleigh;
    asbel.data.datasets[0].data[4] = tamotsu;
    asbel.data.datasets[0].data[5] = cheyeene;
    asbel.data.datasets[0].data[6] = catelin;
    asbel.data.datasets[0].data[7] = royalte;
    cetric.data.datasets[0].data[2] = janinne;
    cetric.data.datasets[0].data[10] = joshuacaleb;
    cetric.data.datasets[0].data[3] = mehrdad;
    cetric.data.datasets[0].data[11] = aydah;
    cetric.data.datasets[0].data[1] = leiyah;
    cetric.data.datasets[0].data[9] = sekia;
    cetric.data.datasets[0].data[5] = ciyana;
    cetric.data.datasets[0].data[13] = neekon;
    cetric.data.datasets[0].data[6] = jamorion;
    cetric.data.datasets[0].data[14] = kunal;
    cetric.data.datasets[0].data[7] = kaylisha;
    cetric.data.datasets[0].data[15] = petronilo;
    cetric.data.labels[2] = "Nativist: " + janinne + "%";
    cetric.data.labels[10] = "Cosmopolitan: " + joshuacaleb + "%";
    cetric.data.labels[3] = "Traditionalist: " + mehrdad + "%";
    cetric.data.labels[11] = "Modernist: " + aydah + "%";
    cetric.data.labels[5] = "Low Spending: " + ciyana + "%";
    cetric.data.labels[13] = "High Spending: " + neekon + "%";
    cetric.data.labels[1] = "Authoritarian: " + leiyah + "%";
    cetric.data.labels[9] = "Liberal: " + sekia + "%";
    cetric.data.labels[6] = "Privatization: " + jamorion + "%";
    cetric.data.labels[14] = "Nationalization: " + kunal + "%";
    cetric.data.labels[7] = "Deregulations: " + kaylisha + "%";
    cetric.data.labels[15] = "Regulations: " + petronilo + "%";
    cetric.data.datasets[0].data[0] = jylian;
    cetric.data.datasets[0].data[8] = senetria;
    cetric.data.datasets[0].data[4] = pameal;
    cetric.data.datasets[0].data[12] = syrenity;
    cetric.data.labels[0] = "Statism: " + jylian + "%";
    cetric.data.labels[8] = "Minarchism: " + senetria + "%";
    cetric.data.labels[4] = "Right: " + pameal + "%";
    cetric.data.labels[12] = "Left: " + syrenity + "%";
    if (kohlten == 4) {
      cetric.data.datasets[0].data[2] = 0;
      cetric.data.datasets[0].data[10] = 0;
      cetric.data.datasets[0].data[3] = 0;
      cetric.data.datasets[0].data[11] = 0;
      cetric.data.datasets[0].data[1] = 0;
      cetric.data.datasets[0].data[9] = 0;
      cetric.data.datasets[0].data[5] = 0;
      cetric.data.datasets[0].data[13] = 0;
      cetric.data.datasets[0].data[6] = 0;
      cetric.data.datasets[0].data[14] = 0;
      cetric.data.datasets[0].data[7] = 0;
      cetric.data.datasets[0].data[15] = 0;
      cetric.data.labels[2] = "Nativist: 0%";
      cetric.data.labels[10] = "Cosmopolitan: 0%";
      cetric.data.labels[3] = "Traditionalist: 0%";
      cetric.data.labels[11] = "Modernist: 0%";
      cetric.data.labels[5] = "Low Spending: 0%";
      cetric.data.labels[13] = "High Spending: 0%";
      cetric.data.labels[1] = "Authoritarian: 0%";
      cetric.data.labels[9] = "Liberal: 0%";
      cetric.data.labels[6] = "Privatization: 0%";
      cetric.data.labels[14] = "Nationalization: 0%";
      cetric.data.labels[7] = "Deregulations: 0%";
      cetric.data.labels[15] = "Regulations: 0%";
      cetric.data.datasets[0].data[0] = 0;
      cetric.data.datasets[0].data[8] = 0;
      cetric.data.datasets[0].data[4] = 0;
      cetric.data.datasets[0].data[12] = 0;
      cetric.data.labels[0] = "Statism: 0%";
      cetric.data.labels[8] = "Minarchism: 0%";
      cetric.data.labels[4] = "Right: 0%";
      cetric.data.labels[12] = "Left: 0%";
    }
    ;
    for (var gotham = 0; gotham < daleisa.length; gotham++) {
      zayneb.datasets[0].data[gotham + 1] = daleisa[gotham].owfun1 * (daleisa[gotham].sectgdpprc / 100);
      zayneb.datasets[1].data[gotham + 1] = daleisa[gotham].owfun2 * (daleisa[gotham].sectgdpprc / 100);
      zayneb.datasets[2].data[gotham + 1] = daleisa[gotham].owfun3 * (daleisa[gotham].sectgdpprc / 100);
      zayneb.datasets[3].data[gotham + 1] = daleisa[gotham].owfun4 * (daleisa[gotham].sectgdpprc / 100);
    }
    ;
    if (kohlten == 3 && tanushree == 1) {
      zayneb.datasets[3].data[0] = lilo * 100 / cheo;
      zayneb.datasets[0].data[0] = 0;
    } else {
      if (kohlten == 4) {
        for (var gotham = 0; gotham < daleisa.length; gotham++) {
          zayneb.datasets[0].data[gotham + 1] = 0;
          zayneb.datasets[1].data[gotham + 1] = 0;
          zayneb.datasets[2].data[gotham + 1] = 0;
          zayneb.datasets[3].data[gotham + 1] = 0;
        }
        ;
        zayneb.datasets[0].data[0] = 0;
        zayneb.datasets[3].data[0] = 0;
      } else {
        zayneb.datasets[0].data[0] = lilo * 100 / cheo;
        zayneb.datasets[3].data[0] = 0;
      }
    }
    ;
    if ($("#budsect").val() == 0) {
      zayneb.labels[0] = "Government: $" + lilo.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[1] = "Education: $" + daleisa[0].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[2] = "Media: $" + daleisa[1].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[3] = "Finance: $" + daleisa[2].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[4] = "Healthcare: $" + daleisa[3].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[5] = "Retail: $" + daleisa[4].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[6] = "Manufacturing: $" + daleisa[5].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[7] = "Construction: $" + daleisa[6].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[8] = "Agriculture: $" + daleisa[7].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[9] = "Natural Resources: $" + daleisa[8].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      zayneb.labels[10] = "Real Estate: $" + daleisa[9].sectgdp.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
    } else {
      if ($("#budsect").val() == 1) {
        zayneb.labels[0] = "Government: " + (lilo * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of GDP";
        zayneb.labels[1] = "Education: " + (daleisa[0].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[2] = "Media: " + (daleisa[1].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[3] = "Finance: " + (daleisa[2].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[4] = "Healthcare: " + (daleisa[3].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[5] = "Retail: " + (daleisa[4].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[6] = "Manufacturing: " + (daleisa[5].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[7] = "Construction: " + (daleisa[6].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[8] = "Agriculture: " + (daleisa[7].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[9] = "Natural Resources: " + (daleisa[8].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        zayneb.labels[10] = "Real Estate: " + (daleisa[9].sectgdp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
      }
    }
    ;
    if (kohlten == 4) {
      zayneb.labels[0] = "Government: 0";
      zayneb.labels[1] = "Education: 0";
      zayneb.labels[2] = "Media: 0";
      zayneb.labels[3] = "Finance: 0";
      zayneb.labels[4] = "Healthcare: 0";
      zayneb.labels[5] = "Retail: 0";
      zayneb.labels[6] = "Manufacturing: 0";
      zayneb.labels[7] = "Construction: 0";
      zayneb.labels[8] = "Agriculture: 0";
      zayneb.labels[9] = "Natural Resources: 0";
      zayneb.labels[10] = "Real Estate: 0";
    }
    ;
    if ($("#budset2").val() == 0) {
      mucad.data.labels[0] = "Corporate Taxes: $" + bentli.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      mucad.data.labels[1] = "Personal Taxes: $" + jaxson.toLocaleString(undefined, {maximumFractionDigits: 1});
      mucad.data.labels[2] = "Consumption Taxes: $" + paulann.toLocaleString(undefined, {maximumFractionDigits: 1});
      mucad.data.labels[3] = "Import Tariffs: $" + phillipp.toLocaleString(undefined, {maximumFractionDigits: 1});
      mucad.data.labels[4] = "Export Tariffs: $" + anooj.toLocaleString(undefined, {maximumFractionDigits: 1});
      mucad.data.labels[5] = "Inheritance Tax: $" + roohi.toLocaleString(undefined, {maximumFractionDigits: 1});
      mucad.data.labels[6] = "Real Estate: $" + tynlie.toLocaleString(undefined, {maximumFractionDigits: 1});
      mucad.data.labels[7] = "Public Industries: $" + inis.toLocaleString(undefined, {maximumFractionDigits: 1});
      mucad.data.labels[8] = "Other: $" + izaiyah.toLocaleString(undefined, {maximumFractionDigits: 1});
      asbel.data.labels[0] = "Military: $" + vice.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      asbel.data.labels[1] = "Welfare: $" + kateisha.toLocaleString(undefined, {maximumFractionDigits: 1});
      asbel.data.labels[2] = "Education: $" + engels.toLocaleString(undefined, {maximumFractionDigits: 1});
      asbel.data.labels[3] = "Science: $" + myleigh.toLocaleString(undefined, {maximumFractionDigits: 1});
      asbel.data.labels[4] = "Environment: $" + tamotsu.toLocaleString(undefined, {maximumFractionDigits: 1});
      asbel.data.labels[5] = "Housing: $" + cheyeene.toLocaleString(undefined, {maximumFractionDigits: 1});
      asbel.data.labels[6] = "Industries: $" + catelin.toLocaleString(undefined, {maximumFractionDigits: 1});
      asbel.data.labels[7] = "Other: $" + royalte.toLocaleString(undefined, {maximumFractionDigits: 1});
    } else {
      if ($("#budset2").val() == 1) {
        mucad.data.labels[0] = "Corporate Taxes: " + (bentli * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        mucad.data.labels[1] = "Personal Taxes: " + (jaxson * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        mucad.data.labels[2] = "Consumption Taxes: " + (paulann * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        mucad.data.labels[3] = "Import Tariffs: " + (phillipp * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        mucad.data.labels[4] = "Export Tariffs: " + (anooj * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        mucad.data.labels[5] = "Inheritance Tax: " + (roohi * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        mucad.data.labels[6] = "Real Estate: " + (tynlie * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        mucad.data.labels[7] = "Public Industries: " + (inis * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        mucad.data.labels[8] = "Other: " + (izaiyah * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        asbel.data.labels[0] = "Military: " + (vice * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        asbel.data.labels[1] = "Welfare: " + (kateisha * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        asbel.data.labels[2] = "Education: " + (engels * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        asbel.data.labels[3] = "Science: " + (myleigh * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        asbel.data.labels[4] = "Environment: " + (tamotsu * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        asbel.data.labels[5] = "Housing: " + (cheyeene * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        asbel.data.labels[6] = "Industries: " + (catelin * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        asbel.data.labels[7] = "Other: " + (royalte * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
      } else {
        if ($("#budset2").val() == 2) {
          mucad.data.labels[0] = "Corporate Taxes: " + (bentli * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of GDP";
          mucad.data.labels[1] = "Personal Taxes: " + (jaxson * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          mucad.data.labels[2] = "Consumption Taxes: " + (paulann * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          mucad.data.labels[3] = "Import Tariffs: " + (phillipp * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          mucad.data.labels[4] = "Export Tariffs: " + (anooj * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          mucad.data.labels[5] = "Inheritance Tax: " + (roohi * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          mucad.data.labels[6] = "Real Estate: " + (tynlie * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          mucad.data.labels[7] = "Public Industries: " + (inis * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          mucad.data.labels[8] = "Other: " + (izaiyah * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          asbel.data.labels[0] = "Military: " + (vice * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of GDP";
          asbel.data.labels[1] = "Welfare: " + (kateisha * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          asbel.data.labels[2] = "Education: " + (engels * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          asbel.data.labels[3] = "Science: " + (myleigh * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          asbel.data.labels[4] = "Environment: " + (tamotsu * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          asbel.data.labels[5] = "Housing: " + (cheyeene * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          asbel.data.labels[6] = "Industries: " + (catelin * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
          asbel.data.labels[7] = "Other: " + (royalte * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "%";
        }
      }
    }
    ;
    if ($("#budset").val() == 0) {
      if (geo < 0) {
        $(".balan").html("Budget Deficit: $" + Math.abs(geo).toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln");
        $(".balan").css("color", "#cd4c4c");
        $(".balan").hover(function () {
          $(this).css("color", "#ea3939");
        }, function () {
          $(this).css("color", "#cd4c4c");
        });
      } else {
        if (geo > 0) {
          $(".balan").html("Budget Surplus: $" + Math.abs(geo).toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln");
          $(".balan").css("color", "#40922f");
          $(".balan").hover(function () {
            $(this).css("color", "#4cad38");
          }, function () {
            $(this).css("color", "#40922f");
          });
        } else {
          if (geo == 0) {
            $(".balan").html("Budget Balance: $0");
            $(".balan").css("color", "#aeaeb7");
            $(".balan").hover(function () {
              $(this).css("color", "#e4e4e7");
            }, function () {
              $(this).css("color", "#aeaeb7");
            });
          }
        }
      }
      ;
      mucad.options.title.text = "Income: $" + joris.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
      asbel.options.title.text = "Spending: $" + iria.toLocaleString(undefined, {maximumFractionDigits: 1}) + " Bln";
    } else {
      if ($("#budset").val() == 1) {
        if (geo < 0) {
          $(".balan").html("Budget Deficit: " + Math.abs(geo * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of Spending");
          $(".balan").css("color", "#cd4c4c");
          $(".balan").hover(function () {
            $(this).css("color", "#ea3939");
          }, function () {
            $(this).css("color", "#cd4c4c");
          });
        } else {
          if (geo > 0) {
            $(".balan").html("Budget Surplus: " + Math.abs(geo * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of Income");
            $(".balan").css("color", "#40922f");
            $(".balan").hover(function () {
              $(this).css("color", "#4cad38");
            }, function () {
              $(this).css("color", "#40922f");
            });
          } else {
            if (geo == 0) {
              $(".balan").html("Budget Balance: 0%");
              $(".balan").css("color", "#aeaeb7");
              $(".balan").hover(function () {
                $(this).css("color", "#e4e4e7");
              }, function () {
                $(this).css("color", "#aeaeb7");
              });
            }
          }
        }
        ;
        mucad.options.title.text = "Income: " + (joris * 100 / iria).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of Spending";
        asbel.options.title.text = "Spending: " + (iria * 100 / joris).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of Income";
      } else {
        if ($("#budset").val() == 2) {
          if (geo < 0) {
            $(".balan").html("Budget Deficit: " + Math.abs(geo * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of GDP");
            $(".balan").css("color", "#cd4c4c");
            $(".balan").hover(function () {
              $(this).css("color", "#ea3939");
            }, function () {
              $(this).css("color", "#cd4c4c");
            });
          } else {
            if (geo > 0) {
              $(".balan").html("Budget Surplus: " + Math.abs(geo * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of GDP");
              $(".balan").css("color", "#40922f");
              $(".balan").hover(function () {
                $(this).css("color", "#4cad38");
              }, function () {
                $(this).css("color", "#40922f");
              });
            } else {
              if (geo == 0) {
                $(".balan").html("Budget Balance: 0% of GDP");
                $(".balan").css("color", "#aeaeb7");
                $(".balan").hover(function () {
                  $(this).css("color", "#e4e4e7");
                }, function () {
                  $(this).css("color", "#aeaeb7");
                });
              }
            }
          }
          ;
          mucad.options.title.text = "Income: " + (joris * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of GDP";
          asbel.options.title.text = "Spending: " + (iria * 100 / monterey).toLocaleString(undefined, {maximumFractionDigits: 1}) + "% of GDP";
        }
      }
    }
    ;
    if (kohlten == 4) {
      mucad.data.labels[0] = "Corporate Taxes: 0";
      mucad.data.labels[1] = "Personal Taxes: 0";
      mucad.data.labels[2] = "Consumption Taxes: 0";
      mucad.data.labels[3] = "Import Tariffs: 0";
      mucad.data.labels[4] = "Export Tariffs: 0";
      mucad.data.labels[5] = "Inheritance Tax: 0";
      mucad.data.labels[6] = "Real Estate: 0";
      mucad.data.labels[7] = "Public Industries: 0";
      mucad.data.labels[8] = "Other: 0";
      asbel.data.labels[0] = "Military: 0";
      asbel.data.labels[1] = "Welfare: 0";
      asbel.data.labels[2] = "Education: 0";
      asbel.data.labels[3] = "Science: 0";
      asbel.data.labels[4] = "Environment: 0";
      asbel.data.labels[5] = "Housing: 0";
      asbel.data.labels[6] = "Industries: 0";
      asbel.data.labels[7] = "Other: 0";
      mucad.data.datasets[0].data[0] = 0;
      mucad.data.datasets[0].data[1] = 0;
      mucad.data.datasets[0].data[2] = 0;
      mucad.data.datasets[0].data[3] = 0;
      mucad.data.datasets[0].data[4] = 0;
      mucad.data.datasets[0].data[5] = 0;
      mucad.data.datasets[0].data[6] = 0;
      mucad.data.datasets[0].data[7] = 0;
      mucad.data.datasets[0].data[8] = 0;
      asbel.data.datasets[0].data[0] = 0;
      asbel.data.datasets[0].data[1] = 0;
      asbel.data.datasets[0].data[2] = 0;
      asbel.data.datasets[0].data[3] = 0;
      asbel.data.datasets[0].data[4] = 0;
      asbel.data.datasets[0].data[5] = 0;
      asbel.data.datasets[0].data[6] = 0;
      asbel.data.datasets[0].data[7] = 0;
      asbel.options.title.text = "Spending: 0";
      mucad.options.title.text = "Income: 0";
      $(".balan").html("Budget Balance: 0");
      $(".gdpnum").html("GDP: 0");
    }
    ;
    window.myHorizontalBar.update();
    window.myPolarArea.update();
    window.myDoughnut.update();
    window.myDoughnut2.update();
    window.myScatter.update();
  }
  $(".slidz").on("slide", function (rajeana) {
    setTimeout(brynda, 0);
  });
  $(".chooser").on("change", function (melio) {
    setTimeout(brynda, 0);
  }).trigger("change");
  function verenis() {
    $("#sov").val("1").trigger("change");
    $("#auto").val("2").trigger("change");
    $("#govg").val("0").trigger("change");
    $("#govc").val("0").trigger("change");
    $("#syse").val("1").trigger("change");
    $("#sysl").val("2").trigger("change");
    $("#sysj").val("2").trigger("change");
    $("#rel").val("1").trigger("change");
    $("#for").val("2").trigger("change");
    $("#cons").val("1").trigger("change");
    $("#righ").val("2").trigger("change");
    $("#minw").val("1").trigger("change");
    $("#minw2").val("1").trigger("change");
    $("#pensreg").val("2").trigger("change");
    $("#centow").val("1").trigger("change");
    $("#votr").val(["0"]).trigger("change");
    $("#entreq").val(["0", "1"]).trigger("change");
    $("#envreg").val(["0", "1"]).trigger("change");
    $("#womrig").val(["0", "1", "2", "3"]).trigger("change");
    $("#centfun").val(["0"]).trigger("change");
    $("#mifu").slider("value", 10);
    $("#imman").slider("value", 0.8);
    $("#immst").slider("value", 40);
    $("#immwo").slider("value", 40);
    $("#immas").slider("value", 10);
    $("#immref").slider("value", 10);
    $("#reserv").slider("value", 25);
    $("#pover").slider("value", 50);
    $("#unemp").slider("value", 50);
    $("#pens").slider("value", 50);
    $("#mininc").slider("value", 25);
    $("#basinc").slider("value", 3);
    $("#wast").slider("value", 50);
    $("#pubpa").slider("value", 50);
    $("#conser").slider("value", 50);
    $("#solar").slider("value", 25);
    $("#nucl").slider("value", 25);
    $("#rnd").slider("value", 8);
    $(".mifu").html("Funding: 10%");
    $(".imman").html("Annual Limit: 0.8%");
    $(".immst").html("Students: 40%");
    $(".immwo").html("Workers: 40%");
    $(".immas").html("Asylees: 10%");
    $(".immref").html("Refugees: 10%");
    $(".reserv").html("Cash Reserve Ratio: 25%");
    $(".pover").html("Poverty Fund: 50%");
    $(".unemp").html("Unemployed Fund: 50%");
    $(".pens").html("Pension Fund: 50%");
    $(".mininc").html("Minimum Income: 25%");
    $(".basinc").html("Basic Income: 3%");
    $(".wast").html("Waste Disposal: 50%");
    $(".pubpa").html("Public Parks: 50%");
    $(".conser").html("Conservation: 50%");
    $(".solar").html("Solar Energy: 25%");
    $(".nucl").html("Nuclear Energy: 25%");
    $(".rnd").html("Science: 8%");
    $("#inher").slider("values", 0, 0);
    $("#inher").slider("values", 1, 6);
    $(".inher").html("Inheritance Tax: 0% - 6%");
  }
  function jmarion() {
    $("#murd").val("2").trigger("change");
    $("#rape").val("2").trigger("change");
    $("#steal").val("0").trigger("change");
    $("#child").val("2").trigger("change");
    $("#defa").val("1").trigger("change");
    $("#incit").val("2").trigger("change");
    $("#stprost").val("2").trigger("change");
    $("#broth").val("2").trigger("change");
    $("#esco").val("2").trigger("change");
    $("#hand").val("2").trigger("change");
    $("#shot").val("2").trigger("change");
    $("#rifle").val("2").trigger("change");
    $("#casin").val("2").trigger("change");
    $("#oncasin").val("2").trigger("change");
    $("#sports").val("2").trigger("change");
    $("#homogen").val("1").trigger("change");
    $("#homoad").val("1").trigger("change");
    $("#transgen").val("1").trigger("change");
    $("#transad").val("2").trigger("change");
    $("#tobus").val("2").trigger("change");
    $("#tobsel").val("2").trigger("change");
    $("#alcus").val("2").trigger("change");
    $("#alcsel").val("2").trigger("change");
    $("#canus").val("2").trigger("change");
    $("#cansel").val("2").trigger("change");
    $("#psyus").val("2").trigger("change");
    $("#psysel").val("2").trigger("change");
    $("#stius").val("2").trigger("change");
    $("#stisel").val("2").trigger("change");
    $("#opius").val("2").trigger("change");
    $("#opisel").val("2").trigger("change");
    $("#euth").val("2").trigger("change");
    $("#obsc").val("1").trigger("change");
    $("#warc").val("4").trigger("change");
    $("#corf").val("1").trigger("change");
    $("#blasph").val("0").trigger("change");
    $("#treas").val("2").trigger("change");
    $("#embe").val("2").trigger("change");
    $("#misce").val("0").trigger("change");
    $("#disse").val("0").trigger("change");
    $("#abort").val(["1", "2"]).trigger("change");
    $("#fabort").val([]).trigger("change");
  }
  function armard() {
    $("#allsow").slider("value", 30);
    $("#allsfun").slider("value", 15);
    $("#allsinc").slider("values", 0, 0);
    $("#allsinc").slider("values", 1, 50);
    $("#allscor").slider("values", 0, 0);
    $("#allscor").slider("values", 1, 50);
    $("#allscons").slider("value", 12);
    $("#allsimp").slider("value", 25);
    $("#allsexp").slider("value", 25);
    $(".allsow").html("Public Ownership: 30%");
    $(".allsfun").html("Subsidies: 15%");
    $(".allsinc").html("Personal Tax: 0% - 50%");
    $(".allscor").html("Corporate Tax: 0% - 50%");
    $(".allscons").html("Consumption Tax: 12%");
    $(".allsimp").html("Import Tariffs: 25%");
    $(".allsexp").html("Export Tariffs: 25%");
    $("#allsprc").slider("value", 0);
    $("#allswag").slider("value", 0);
    $("#allswagr").slider("value", 0);
    $(".allsprc").html("Prices: 0%");
    $(".allswag").html("Wages: 0%");
    $(".allswagr").html("Wage Ratio: 100");
    $("#edugdp").slider("value", 4.1);
    $("#medgdp").slider("value", 3.1);
    $("#bankgdp").slider("value", 9.7);
    $("#heagdp").slider("value", 9);
    $("#retgdp").slider("value", 13.6);
    $("#manugdp").slider("value", 27.8);
    $("#infrgdp").slider("value", 4.4);
    $("#agrgdp").slider("value", 1.4);
    $("#reagdp").slider("value", 8.8);
    $("#natgdp").slider("value", 2.6);
    $(".edugdp").html("Education: 4.1%");
    $(".medgdp").html("Media: 3.1%");
    $(".bankgdp").html("Finance: 9.7%");
    $(".heagdp").html("Healthcare: 9%");
    $(".retgdp").html("Retail: 13.6%");
    $(".manugdp").html("Manufacturing: 27.8%");
    $(".infrgdp").html("Construction: 4.4%");
    $(".agrgdp").html("Agriculture: 1.4%");
    $(".reagdp").html("Real Estate: 8.8%");
    $(".natgdp").html("Natural Resources: 2.6%");
    $("#gdpval").slider("value", 18e3);
    $(".gdpval").html("GDP Multiplier: 18,000");
    for (i = 0; i < daleisa.length; i++) {
      $("#" + daleisa[i].id + "ow").slider("value", 30);
      $("#" + daleisa[i].id + "fun").slider("value", 15);
      $("#" + daleisa[i].id + "inc").slider("values", 0, 0);
      $("#" + daleisa[i].id + "inc").slider("values", 1, 50);
      $("#" + daleisa[i].id + "cor").slider("values", 0, 0);
      $("#" + daleisa[i].id + "cor").slider("values", 1, 50);
      $("#" + daleisa[i].id + "cons").slider("value", 12);
      $("#" + daleisa[i].id + "imp").slider("value", 25);
      $("#" + daleisa[i].id + "exp").slider("value", 25);
      $("." + daleisa[i].id + "ow").html("Public Ownership: 30%");
      $("." + daleisa[i].id + "fun").html("Subsidies: 15%");
      $("." + daleisa[i].id + "inc").html("Personal Tax: 0% - 50%");
      $("." + daleisa[i].id + "cor").html("Corporate Tax: 0% - 50%");
      $("." + daleisa[i].id + "cons").html("Consumption Tax: 12%");
      $("." + daleisa[i].id + "imp").html("Import Tariffs: 25%");
      $("." + daleisa[i].id + "exp").html("Export Tariffs: 25%");
      $("#" + daleisa[i].id + "prc").slider("value", 0);
      $("#" + daleisa[i].id + "wag").slider("value", 0);
      $("#" + daleisa[i].id + "wagr").slider("value", 0);
      $("." + daleisa[i].id + "prc").html("Prices: 0%");
      $("." + daleisa[i].id + "wag").html("Wages: 0%");
      $("." + daleisa[i].id + "wagr").html("Wage Ratio: 100");
    }
    ;
    $(".bankcons").html("Capital Gains Tax: 12%");
    $("#reareg0").slider("value", 20);
    $("#reareg1").slider("value", 6);
    $("#reareg2").slider("value", 6);
    $("#reareg3").slider("value", 15);
    $("#reareg4").slider("value", 15);
    $(".reareg0").html("Subsidies: 20%");
    $(".reareg1").html("Land Tax: 6%");
    $(".reareg2").html("Property Tax: 6%");
    $(".reareg3").html("Rent Tax: 15%");
    $(".reareg4").html("Sales Tax: 15%");
    $("#reacom1").slider("value", 0);
    $("#reacom2").slider("value", 0);
    $(".reacom1").html("Selling Prices: 0%");
    $(".reacom2").html("Renting Prices: 0%");
    $("#sov").trigger("change");
  }
  $(".resgov").click(verenis);
  $(".reslaw").click(jmarion);
  $(".ressec").click(armard);
  $(".resall").click(function () {
    verenis();
    jmarion();
    armard();
  });
};
