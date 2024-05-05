using System.Security.Claims;
using Microsoft.EntityFrameworkCore;
using montisgal_events.Business.Dtos.Group;
using montisgal_events.Business.Mappers;
using montisgal_events.Data;

namespace montisgal_events.Business.UseCases.Group;

public class GetGroupsUseCase(ApplicationDbContext applicationDbContext, IHttpContextAccessor contextAccessor)
{
    public async Task<List<GroupDto>> Execute()
    {
        var userId = contextAccessor.HttpContext.User.FindFirst(ClaimTypes.NameIdentifier).Value;
        var response = await applicationDbContext.Groups
            .Where(group => group.OwnerId == userId).AsNoTracking().ToListAsync();

        return response.ToDto();
    }
}