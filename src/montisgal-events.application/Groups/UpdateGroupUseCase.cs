using montisgal_events.domain.Groups;

namespace montisgal_events.application.Groups;

public class UpdateGroupUseCase(IGroupRepository repository)
{
    public async Task<Group?> Execute(Guid id, Guid ownerId, string updatedName, string updatedDescription, bool updatedVisibility)
    {
        throw new NotImplementedException();
        // var group = await repository.GetGroup(id, ownerId);
        //
        // if (group is null) return null;
        //
        // group = GroupService.UpdateGroup(group, updatedName, updatedDescription, updatedVisibility);
        //
        // return await repository.UpdateGroup(group);
    }
}