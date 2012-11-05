from django.shortcuts import render, get_object_or_404
from waterprofiles.models import WaterProfile

def waterprofiles(request):
    profiles = WaterProfile.objects.all()
    return render(request,
        'waterprofiles.html',
        {'profiles': profiles,}
    )

def waterprofile_details(request, waterprofile_id):
    profile = get_object_or_404(WaterProfile, pk=waterprofile_id)
    return render(request,
        'waterprofile_details.html',
        {'profile': profile,}
    )