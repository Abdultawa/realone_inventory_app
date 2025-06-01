"use strict";
var KTCreateAccount = function () {
    var e, t, i, o, a, r, s = [];
    return {
        init: function () {
            (
                e = document.querySelector("#kt_modal_create_account")) &&
                new bootstrap.Modal(e),
                (t = document.querySelector("#kt_stepper_example_basic")) && (i = t.querySelector("#kt_stepper_example_basic_form"),
                    o = t.querySelector('[data-kt-stepper-action="submit"]'),
                    a = t.querySelector('[data-kt-stepper-action="next"]'),
                    (r = new KTStepper(t)).on("kt.stepper.changed", (function (e) {
                        4 === r.getCurrentStepIndex() ? (o.classList.remove("d-none"),
                            o.classList.add("d-inline-block"),
                            a.classList.add("d-none")) : 5 === r.getCurrentStepIndex() ? (o.classList.add("d-none"),
                                a.classList.add("d-none")) : (o.classList.remove("d-inline-block"),
                                    o.classList.remove("d-none"),
                                    a.classList.remove("d-none"))
                    }
                    )),
                    r.on("kt.stepper.next", (function (e) {
                        console.log("stepper.next");
                        var t = s[e.getCurrentStepIndex() - 1];
                        t ? t.validate().then((function (t) {
                            console.log("validated!"),
                                "Valid" == t ? (e.goNext(),
                                    KTUtil.scrollTop()) : Swal.fire({
                                        text: "Sorry, looks like there are some errors detected, please try again.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-light"
                                        }
                                    }).then((function () {
                                        KTUtil.scrollTop()
                                    }
                                    ))
                        }
                        )) : (e.goNext(),
                            KTUtil.scrollTop())
                    }
                    )),
                    r.on("kt.stepper.previous", (function (e) {
                        console.log("stepper.previous"),
                            e.goPrevious(),
                            KTUtil.scrollTop()
                    }
                    )),
                    s.push(FormValidation.formValidation(i, {
                        fields: {
                            first_name: {
                                validators: {
                                    notEmpty: { message: 'First name is required'}
                                }
                            },
                            last_name: {
                                validators: {
                                    notEmpty: { message: 'Last name is required'}
                                }
                            },
                            gender: {
                                validators: {
                                    notEmpty: { message: 'Gender is required'}
                                }
                            },
                            dob: {
                                validators: {
                                    notEmpty: { message: 'Date of birth is required'}
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    })),
                    s.push(FormValidation.formValidation(i, {
                        fields: {
                            address: {
                                validators: {
                                    notEmpty: { message: 'Address is required'}
                                }
                            },
                            state: {
                                validators: {
                                    notEmpty: { message: 'State is required'}
                                }
                            },
                            lga: {
                                validators: {
                                    notEmpty: { message: 'LGA is required'}
                                }
                            },
                            origin: {
                                validators: {
                                    notEmpty: { message: 'Origin is required'}
                                }
                            },
                            country: {
                                validators: {
                                    notEmpty: { message: 'Country is required'}
                                }
                            },
                            means: {
                                validators: {
                                    notEmpty: { message: 'Means of identification is required'}
                                }
                            },
                            identification: {
                                validators: {
                                    notEmpty: { message: 'Document number is required'}
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    })),
                    s.push(FormValidation.formValidation(i, {
                        fields: {
                            kin_first_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Next of kin first name is required'
                                    }
                                }
                            },
                            kin_last_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'Next of kin last name is required'
                                    }
                                }
                            },
                            kin_phone: {
                                validators: {
                                    notEmpty: {
                                        message: 'Next of kin phone number is required'
                                    }
                                }
                            },
                            kin_relationship: {
                                validators: {
                                    notEmpty: {
                                        message: 'Next of kin relationship is required'
                                    }
                                }
                            },
                            kin_email: {
                                validators: {
                                    notEmpty: {
                                        message: 'Next of kin email is required'
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    })),
                    o.addEventListener("click", (function (e){
                        s[2].validate().then((function (t) {
                                console.log("validated!"),
                                "Valid" == t ? (e.preventDefault(),
                                dataSendJs()
                                // o.disabled = !0
                                    // document.getElementById('kt_stepper_example_basic_form').submit()
                                    // o.setAttribute("data-kt-indicator", "on"),
                                    // setTimeout((function () {
                                    //     o.removeAttribute("data-kt-indicator"),
                                    //         o.disabled = !1,
                                    //         r.goNext()
                                    // }
                                    // ), 2e3)
                                ): Swal.fire({
                                        text: "Sorry, looks like there are some errors detected, please try again.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-light"
                                        }
                                    }).then((function () {
                                        KTUtil.scrollTop()
                                    }
                                    ))
                            }
                        ))
                    }))
                    // $(i.querySelector('[name="card_expiry_month"]')).on("change", (function () {
                    //     s[3].revalidateField("card_expiry_month")
                    // })),
                    // $(i.querySelector('[name="card_expiry_year"]')).on("change", (function () {
                    //     s[3].revalidateField("card_expiry_year")
                    // })),
                    // $(i.querySelector('[name="business_type"]')).on("change", (function () {
                    //     s[2].revalidateField("business_type")
                    // }))
            )
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTCreateAccount.init()
}
));
