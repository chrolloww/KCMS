function collaborationDetails(c_name) {
  window.location.href = "{{ url('/collaborations') }}_" + encodeURIComponent(c_name);
}
